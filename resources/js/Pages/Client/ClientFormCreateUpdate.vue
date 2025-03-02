<template>
    <form @submit.prevent="submit()">
        <div class="grid md:grid-cols-2 mt-2 gap-3">
            <el-floating-input :form="el_form" required name="name"/>
            <el-floating-input :form="el_form" name="phone" required/>
            <el-floating-input :form="el_form" name="national_id" required/>
            <el-floating-textarea :form="el_form" name="note" class="col-span-full mt-5 mb-5"/>
            <div class="col-span-full flex justify-between">
                <ElAvatarInput :form="el_form" :old-image-preview="el_form.national_id_img_front_url" name="national_id_img_front"/>
                <ElAvatarInput :form="el_form" :old-image-preview="el_form.national_id_img_back_url" name="national_id_img_back"/>
            </div>
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
import ElSecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";
import ElAvatarInput from "@/Components/Form/ElAvatarInput.vue";
import ElFloatingTextarea from "@/Components/Form/ElFloatingTextarea.vue";

const emit = defineEmits(['hide']);

const props = defineProps({
    row: {
        type: Array,
        default: {}
    },
    form_data:{
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
    national_id: el_row?.national_id,
    note: el_row?.note,
    national_id_img_front: null,
    national_id_img_front_url: el_row?.national_id_img_front_url,
    national_id_img_back: null,
    national_id_img_back_url: el_row?.national_id_img_back_url,
})
const submit = () => {
    el_form.post(is_create ? route('dashboard.client.store') : route('dashboard.client.update', el_form.id), {
        preserveState: true,
        onSuccess: () => {
            is_create && el_form.reset();
        },
    })
}

</script>
