<template>
    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-2 mt-2 gap-3">
            <el-floating-input :form="el_form" required name="name"/>
            <el-floating-input :form="el_form" name="phone"/>
            <el-floating-input :form="el_form" name="country"/>
            <el-floating-dropdown :form="el_form" name="currency_id" required :options="form_data.currencies"/>
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
import ElFloatingPrice from "@/Components/Form/ElFloatingPrice.vue";

const emit = defineEmits(['hide']);

const props = defineProps({
    row: {
        type: Array,
        default: {}
    },
    form_data: {
        type: Object,
        default: null,
    }
})
const is_create = !props?.row?.id;
const el_row = props?.row;
const el_form = useForm({
    id: el_row?.id,
    name: el_row?.name,
    phone: el_row?.phone,
    country: el_row?.country,
    currency_id: el_row?.currency_id,
})
const submit = () => {
    el_form.post(is_create ? route('dashboard.supplier.store') : route('dashboard.supplier.update', el_form.id), {
        preserveState: true,
        onSuccess: () => {
            is_create && el_form.reset();
        },
    })
}

</script>
