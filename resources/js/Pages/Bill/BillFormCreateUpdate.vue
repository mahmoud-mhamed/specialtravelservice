<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
            <ElFloatingInput :form="el_form" name="client_name" required/>
            <ElFloatingInput :form="el_form" name="service" required/>
            <ElFloatingPrice  required :form="el_form" name="price"/>
            <ElFloatingTextarea :form="el_form" name="notes"/>

            <div class="text-end col-span-full gap-4 w-full mt-4">
                <ElSubmitButton :text="$t('message.save')" :form="el_form"/>
            </div>
        </div>
    </form>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import ElSubmitButton from "@/Components/Buttons/ElSubmitButton.vue";
import ElFloatingPrice from "@/Components/Form/ElFloatingPrice.vue";
import ElFloatingInput from "@/Components/Form/ElFloatingInput.vue";
import ElFloatingTextarea from "@/Components/Form/ElFloatingTextarea.vue";

const props = defineProps({
    form_data: Object,
    row: Object,
});
const is_create = !props?.row?.id;
const el_form = useForm({
    id: props.row?.id,
    client_name: props.row?.client_name,
    service: props.row?.client_id,
    notes: props.row?.notes,
    price: props.row?.price,
});

const submit = () => {
    el_form.post(el_form.id ? route('dashboard.bill.update', el_form.id) : route('dashboard.bill.store'), {
        preserveState: true,
        onSuccess: () => {
            is_create && el_form.reset();
        },
    })
};

</script>
