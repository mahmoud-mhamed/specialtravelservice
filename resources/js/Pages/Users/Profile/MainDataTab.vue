<template>
    <ElContainer>
        <section class="grid grid-cols-2 mt-3 gap-4 text-lg">
            <div>
                <label>{{ $t('column.name') }} : </label>
                <label class="underline">{{ data.row.name }}</label>
            </div>
            <div>
                <label>{{ $t('column.email') }} : </label>
                <label class="underline ">{{ data.row.email }}</label>
            </div>
            <div>
                <label>{{ $t('column.created_at_text') }} : </label>
                <label>{{ data.row.created_at_text }}</label>
            </div>
        </section>
    </ElContainer>

    <ElContainer :title="$t('message.roles')" v-if="props.data.row?.roles.length" class="mt-2">
        <section>
            <div>
                <label>{{ $t('message.role') }} : </label>
                <ul class="inline-block">
                    <li v-for="role in props.data.row?.roles" :key="role.id">
                        <ElRouteRoleProfile :model="role"/>
                    </li>
                </ul>
            </div>
            <div class="flex mt-3">
                <label class="text-lg">{{ $t('message.permissions') }}:</label>
                <div class="w-full">
                    <ul class="block w-full">
                        <li class="underline font-bold">
                            {{ $t('message.role_permission') }}
                        </li>
                        <li>
                            <main v-for="(items, index) of props.data.current_role_abilities">
                                <section class="border-b border-b-black pb-2 mb-2">
                                    <h1 class="text-xl  underline underline-offset-4">
                                        {{ $t('enums.ModuleNameEnum.' + index) }}</h1>
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                        <div v-for="ability of items" :key="items"
                                             class="field-checkbox text-lg">
                                            <label :for="ability.key"
                                                   class="px-1">{{ $t('abilities.' + ability.key) }}</label>
                                        </div>
                                    </div>
                                </section>
                            </main>
                        </li>
                        <li class="underline font-bold" v-if="props.data.active_custom_abilities?.length">
                            {{ $t('message.custom_permission') }}
                        </li>
                        <li>
                            <main v-for="(items, index) of props.data.active_custom_abilities_module">
                                <section class="border-b border-b-black pb-2 mb-2">
                                    <h1 class="text-lg  underline underline-offset-4">
                                        {{ $t('enums.ModuleNameEnum.' + index) }}</h1>
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                                        <div v-for="ability of items" :key="items"
                                             class="field-checkbox text-lg">
                                            <label :for="ability.key" class="px-1">{{
                                                    $t('abilities.' + ability.key)
                                                }}</label>
                                            <IconDeleteButton v-ability="Ability.M_USERS_ADD_CUSTOM_ABILITY"
                                                              @click="removePermission(ability.key)"/>
                                        </div>
                                    </div>
                                </section>
                            </main>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <secondary-button :text="$t('message.edit_permission')" class="mt-3"
                          v-if="props.data.row?.roles?.length"
                          v-ability="Ability.M_USERS_ADD_CUSTOM_ABILITY" @click="dialogEdit = true;"/>

    </ElContainer>
    <Dialog v-model:visible="dialogEdit" :style="{width: '900px'}" :header="$t('message.edit_permission')" :modal="true"
            class="p-fluid">
        <template v-for="(items, index) of props.data.custom_abilities">
            <section class="border-b container-ability border-b-black pb-2 mb-2">
                <h1 class="text-xl  underline underline-offset-4">{{ $t('enums.ModuleNameEnum.' + index) }}</h1>
                <aside class="grid grid-cols-1 md:grid-cols-3 gap-2">
                    <template v-for="ability of items" :key="items">
                        <div class="field-checkbox text-lg">
                            <ElFormCheckbox class="mt-3" :form="form_edit_permission" name="abilities"
                                            :value="ability.key"
                                            :label="$t('abilities.'+ability.key)"/>
                        </div>
                    </template>
                </aside>
            </section>
        </template>
        <template #footer>
            <secondary-button :text="$t('message.cancel')" @click="dialogEdit = false;"/>
            <submit-button :form="form_edit_permission" :text="$t('message.save')" @click="updatePermission"/>
        </template>
    </Dialog>

</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";
import {Ability} from "@/ability.js";
import SecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";
import SubmitButton from "@/Components/Buttons/ElSubmitButton.vue";
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import Dialog from "primevue/dialog";
import IconDeleteButton from "@/Components/Buttons/ElIconDeleteButton.vue";
import ElFormCheckbox from "@/Components/Form/ElFormCheckbox.vue";
import ElRouteRoleProfile from "@/Components/ElRoutes/ElRouteRoleProfile.vue";

const props = defineProps(['data']);
const form_remove_permission = useForm({
    name: null
});
const form_edit_permission = useForm({
    abilities: props.data?.active_custom_abilities ?? [],
});
const removePermission = (name) => {
    form_remove_permission.name = name
    form_remove_permission.delete(route('dashboard.users.remove-custom-permission', props.data.row.id), {
        onSuccess: (response) => {
            // window.location.reload();
        },
        onError: (error) => console.log(error)
    });
}
const dialogEdit = ref(false);

const updatePermission = () => {
    form_edit_permission.post(route('dashboard.users.edit-custom-permission', props.data.row.id), {
        onSuccess: () => {
            dialogEdit.value = false;
        },
        onError: (error) => console.log(error)
    }, {
        forceFormData: true,
    });
}
</script>
