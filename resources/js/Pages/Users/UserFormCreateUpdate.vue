<template>
    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-2 mt-2 gap-3">
            <div class="col-span-full">
                <ElAvatarInput :form="el_form" :old-image-preview="el_form.avatar_url" name="avatar"/>
            </div>

            <el-floating-input :form="el_form" required name="name"/>
            <el-floating-input :form="el_form" required type="email" name="email"/>
            <el-floating-input :form="el_form" name="phone"/>
            <el-floating-password :form="el_form" :required="is_create" name="password"/>

            <el-floating-dropdown :form="el_form" name="role" :required="1"
                               option-value="name" option-label="title" :options="formData.roles"
                               :label="$t('column.role')"/>
            <el-floating-dropdown v-if="!is_create" :form="el_form" name="is_active" :required="1"
                               :options="formData.is_active" :label="$t('column.is_active')"/>
        </div>

        <div class="flex flex-row-reverse gap-2 mt-3">
            <el-secondary-button :text="$t('message.cancel')" @click="emit('hide')" v-if="is_create"/>
            <el-submit-button :text="$t('message.save')" :form="el_form"/>
        </div>
    </form>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import ElFloatingInput from "@/Components/Form/ElFloatingInput.vue";
import ElSubmitButton from "@/Components/Buttons/ElSubmitButton.vue";
import ElFloatingPassword from "@/Components/Form/ElFloatingPassword.vue";
import ElFloatingDropdown from "@/Components/Form/ElFloatingDropdown.vue";
import ElAvatarInput from "@/Components/Form/ElAvatarInput.vue";
import ElSecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";
const emit = defineEmits(['hide']);

const props = defineProps({
    row: {
        type: Array,
        default: {}
    },
    formData: {
        type: Object,
    }
})
const is_create = !props?.row?.id;
const el_row = props?.row;
const el_form = useForm({
    id: el_row?.id,
    avatar: null,
    avatar_url: el_row?.avatar_url??null,
    name: el_row?.name,
    email: el_row?.email ?? null,
    phone: el_row?.phone ?? null,
    password: el_row?.password ?? null,
    role: el_row?.role_name ?? null,
    is_active: is_create ? true : el_row?.is_active,
})
const submit = () => {
    el_form.post(is_create ? route('dashboard.users.store') : route('dashboard.users.update', el_form.id), {
        preserveState:true,
        onSuccess: () => {
            is_create && el_form.reset();
        },
    })
}

</script>
