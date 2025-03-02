<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
            <ElCardWithTitle :title="$t('message.purchase_data')">
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                    <ElFloatingDropdown :form="el_form" name="supplier_id" required :options="form_data.suppliers"/>
                    <ElFloatingInput :form="el_form" name="car_type" required/>
                    <ElFloatingInput :form="el_form" name="chassis_number" required/>
                    <ElFloatingDatePicker :form="el_form" name="purchase_date" required/>
                    <ElFloatingDropdown :form="el_form" required name="purchase_type"
                                        :options="form_data.purchase_types"/>

                    <hr class="col-span-full"/>
                    <ElFloatingDropdown :form="el_form" name="status" required :options="form_data.status"/>
                    <ElFloatingPrice :currency="supplier_currency" required :form="el_form" name="purchase_price"/>

                    <hr class="col-span-full"/>
                    <div class="grid col-span-full md:grid-cols-4 gap-4">
                        <ElFloatingInput :form="el_form" name="shipping_type"/>
                        <ElFloatingDatePicker :form="el_form" name="shipping_date"/>
                        <ElFloatingPrice :currency="supplier_currency" :form="el_form" name="shipping_amount"/>
                        <ElFloatingInput :form="el_form" name="policy_number"/>
                    </div>
                </div>
            </ElCardWithTitle>
            <ElCardWithTitle :title="$t('message.client_data')">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <ElFloatingDropdown :form="el_form" name="client_id" required :options="form_data.clients"/>
                    <ElFloatingPrice :currency="supplier_currency" required :form="el_form" name="selling_price"/>

                    <hr class="col-span-full"/>
                    <ElAvatarInput :form="el_form" :old-image-preview="props.row?.client_national_id_url"
                                   name="client_national_id"/>
                    <ElFloatingTextarea class="col-span-3" :form="el_form" name="notes"/>
                </div>
            </ElCardWithTitle>

            <ElCardWithTitle
                v-if="el_form.purchase_type && el_form.purchase_type !== Enum.BillPurchaseTypeEnum.PERSONAL"
                :title="el_form.purchase_type === Enum.BillPurchaseTypeEnum.DISABILITY_ANSWER?$t('message.disabled_client_data'):$t('message.initiative_data')">
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                    <ElFloatingDropdown :form="el_form" name="disabled_client_id" :options="form_data.clients"/>

                    <ElAvatarInput :form="el_form" :old-image-preview="props.row?.disabled_client_national_id_url"
                                   name="disabled_client_national_id"/>
                    <ElAvatarInput :form="el_form" :old-image-preview="props.row?.disabled_client_envelope_url"
                                   name="disabled_client_envelope"/>
                    <ElArchiveInput :form="el_form" :old-image-preview="props.row?.smart_card_url"
                                   name="smart_card"/>
                </div>
            </ElCardWithTitle>

            <div class="text-end col-span-full gap-4 w-full mt-4">
                <ElSubmitButton :text="$t('message.save')" :form="el_form"/>
            </div>
        </div>
    </form>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import ElSubmitButton from "@/Components/Buttons/ElSubmitButton.vue";
import ElCardWithTitle from "@/Components/Card/ElCardWithTitle.vue";
import ElFloatingDropdown from "@/Components/Form/ElFloatingDropdown.vue";
import ElFloatingPrice from "@/Components/Form/ElFloatingPrice.vue";
import ElFloatingDatePicker from "@/Components/Form/ElFloatingDatePicker.vue";
import ElFloatingInput from "@/Components/Form/ElFloatingInput.vue";
import ElFloatingTextarea from "@/Components/Form/ElFloatingTextarea.vue";
import {computed, ref, watch} from "vue";
import collect from "collect.js";
import ElAvatarInput from "@/Components/Form/ElAvatarInput.vue";
import {Enum} from "@/enum.js";
import ElArchiveInput from "@/Components/Form/ElArchiveInput.vue";

const props = defineProps({
    form_data: Object,
    row: Object,
});
const is_create = !props?.row?.id;
const supplier_currency = ref(is_create ? null : props.row.currency);
const el_form = useForm({
    id: props.row?.id,
    supplier_id: props.row?.supplier_id,
    client_id: props.row?.client_id,
    disabled_client_id: props.row?.disabled_client_id,
    purchase_price: props.row?.purchase_price,
    purchase_type: props.row?.purchase_type,
    selling_price: props.row?.selling_price,
    purchase_date: props.row?.purchase_date,
    chassis_number: props.row?.chassis_number,
    car_type: props.row?.car_type,
    status: props.row?.status ?? 'pending',
    shipping_date: props.row?.shipping_date,
    shipping_type: props.row?.shipping_type,
    shipping_amount: props.row?.shipping_amount,
    policy_number: props.row?.policy_number,
    notes: props.row?.notes,
    client_national_id: null,
    disabled_client_national_id: null,
    disabled_client_envelope: null,
    smart_card: null,
});

const setSupplierCurrency = () => {
    if (!el_form.supplier_id) {
        supplier_currency.value = null;
        return;
    }

    supplier_currency.value = props.form_data.suppliers.find(supplier => supplier.id === el_form.supplier_id).currency;
}
setSupplierCurrency();
watch(() => el_form.supplier_id, setSupplierCurrency, {deep: true});


const submit = () => {
    el_form.post(el_form.id ? route('dashboard.bill.update', el_form.id) : route('dashboard.bill.store'), {
        preserveState: true,
        onSuccess: () => {
            is_create && el_form.reset();
        },
    })
};

</script>
