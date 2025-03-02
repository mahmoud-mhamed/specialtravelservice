<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-1 gap-4">
            <ElFloatingInput :form="el_form" name="title" required :label="$t('message.role_title')"/>
            <div class="grid grid-cols-2 gap-3">
                <div v-for="(items, index) of abilities" class="bg-white dark:bg-gray-700 dark:text-white mb-6">
                    <aside
                        class="flex justify-between items-center bg-primary_web-500 text-black text-lg p-2 mb-2 dark:bg-gray-900">
                        <span>
                            {{ $t('enums.ModuleNameEnum.' + index) }}
                        </span>
                        <div class="flex items-center">
                            <template
                                v-if="(items.map((x)=>x.key)).every(elem => ((el_form.abilities)??[]).includes(elem))">
                                <el-secondary-button @click="toggleSelect(items,0);" class="!p-1"
                                                     :text="$t('message.deselect_all')"/>
                            </template>
                            <template v-else>
                                <el-secondary-button @click="toggleSelect(items,1);" class="!p-1"
                                                     :text="$t('message.select_all')"/>
                            </template>
                        </div>
                    </aside>
                    <aside class="grid grid-cols-1 md:grid-cols-3 gap-1 py-4 px-2">
                        <div v-for="ability in items" class="block">
                            <label class="flex items-center">
                                <ElFormCheckbox :form="el_form" name="abilities" :value="ability.key"
                                                :label="$t('abilities.'+ability.key)"/>
                            </label>
                        </div>
                    </aside>
                </div>
            </div>

            <div class="text-end gap-4 w-full mt-4">
                <ElSubmitButton :text="$t('message.save')" :form="el_form"/>
            </div>
        </div>
    </form>
</template>

<script setup>
import ElFloatingInput from "@/Components/Form/ElFloatingInput.vue";
import {useForm} from "@inertiajs/vue3";
import ElSubmitButton from "@/Components/Buttons/ElSubmitButton.vue";
import ElFormCheckbox from "@/Components/Form/ElFormCheckbox.vue";
import ElSecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";

const props = defineProps({
    role: Object,
    abilities: Object,
    current_abilities: Object,
});
const is_create = !props?.role?.id;

const el_form = useForm({
    id: props.role?.id ?? null,
    title: props.role?.title ?? null,
    abilities: props.current_abilities ?? [],
});

const toggleSelect = (abilities, state = 0) => {
    for (const item_key in abilities) {
        if (state) {
            let index = el_form.abilities.indexOf(abilities[item_key].key);
            if (index === -1) {
                el_form.abilities.push(abilities[item_key].key);
            }
        } else {
            const index = el_form.abilities.indexOf(abilities[item_key].key);
            el_form.abilities.splice(index, 1);
        }
    }
}

const submit = () => {
    el_form.post(el_form.id ? route('dashboard.roles.update', el_form.id) : route('dashboard.roles.store'), {
        preserveState: true,
        onSuccess: () => {
            is_create && el_form.reset();
        },
    })
};
</script>
