<template>
    <form @submit.prevent="submit()">
        <div v-if="is_create" class="mb-3">
            <ElLabelValuePrice :label="$t('column.rent')" :currency="form_data.bill_currency" :value="form_data.rent"/>
        </div>
        <div class="grid md:grid-cols-2 mt-2 gap-3">
            <el-floating-dropdown :form="el_form" required name="paid_currency_id" :options="form_data.currencies"/>

            <el-floating-price :form="el_form" required name="paid_amount"
                               :currency="selected_paid_currency"/>

            <ElFloatingDatePicker :form="el_form" required name="payment_date"/>

            <template v-if="el_form.paid_currency_id && el_form.paid_currency_id !== form_data.bill_currency.id">
                <el-floating-price :form="el_form" required name="bill_currency_equal_value"
                                   :label="1 + ' '+selected_paid_currency?.name + ' = ........ '+form_data.bill_currency.name "
                                   :currency="form_data.bill_currency"/>

                <div class="flex items-center">
                    <ElLabelValuePrice :label="$t('column.bill_currency_equal_total')"
                                       :currency="form_data.bill_currency"
                                       v-if="el_form.bill_currency_equal_value && el_form.paid_amount"
                                       :value="(el_form.bill_currency_equal_value * el_form.paid_amount).toFixed(4)"/>

                    <ElLabelValuePrice v-else :label="$t('column.bill_currency_equal_total')"
                                       :currency="form_data.bill_currency"/>

                </div>
            </template>

            <ElArchiveInput :form="el_form" :old-image-preview="props.row?.proof_archive?.file_url"
                            name="proof_archive_id"/>
            <ElFloatingTextarea class="col-span-full" :form="el_form" name="note"/>

        </div>

        <div class="flex flex-row-reverse gap-2 mt-3">
            <el-secondary-button :text="$t('message.cancel')" @click="emit('hide')" v-if="is_create"/>
            <el-submit-button :text="$t('message.save')" :form="el_form"/>
        </div>
    </form>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import ElSubmitButton from "@/Components/Buttons/ElSubmitButton.vue";
import ElFloatingDropdown from "@/Components/Form/ElFloatingDropdown.vue";
import ElSecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";
import ElFloatingPrice from "@/Components/Form/ElFloatingPrice.vue";
import {collect} from "collect.js";
import ElFloatingTextarea from "@/Components/Form/ElFloatingTextarea.vue";
import ElFloatingDatePicker from "@/Components/Form/ElFloatingDatePicker.vue";
import ElArchiveInput from "@/Components/Form/ElArchiveInput.vue";
import ElLabelValuePrice from "@/Components/Text/ElLabelValuePrice.vue";
import {ref, watch} from "vue";

const emit = defineEmits(['hide']);

const props = defineProps({
    row: {
        type: Array,
        default: {}
    },
    form_data: {
        type: Object,
        default: null,
    },
    bill_id: {
        type: Number,
    },
    type: {
        type: String,
    }
})
const is_create = !props?.row?.id;
const el_row = props?.row;
const el_form = useForm({
    id: el_row?.id,
    bill_id: el_row?.name,
    paid_amount: el_row?.paid_amount,
    paid_currency_id: el_row?.paid_currency_id,
    bill_currency_equal_value: el_row?.bill_currency_equal_value,
    bill_currency_equal_total: el_row?.bill_currency_equal_total,
    type: props?.type,
    note: el_row?.note,
    payment_date: el_row?.payment_date,
    proof_archive_id: null,
});
const selected_paid_currency = ref();
let collect_currencies = collect(props.form_data.currencies);
const selectPaidCurrency = () => {

    if (!el_form.paid_currency_id) {
        selected_paid_currency.value = null;
        el_form.bill_currency_equal_value = null;
        return;
    }
    selected_paid_currency.value = collect_currencies.where('id', el_form.paid_currency_id).first();
    if (el_form.paid_currency_id === props.form_data.bill_currency.id) {
        el_form.bill_currency_equal_value = 1;
        return;
    }
}
if (!is_create)
    selectPaidCurrency();

watch(() => el_form.paid_currency_id, selectPaidCurrency, {deep: true});

const submit = () => {
    if (el_form.paid_amount && el_form.bill_currency_equal_value)
        el_form.bill_currency_equal_total = el_form.bill_currency_equal_value * el_form.paid_amount;
    el_form.post(is_create ? route('dashboard.bill-payment.store', props.form_data.bill_id) : route('dashboard.bill-payment.update', el_form.id), {
        preserveState: true,
        onSuccess: () => {
            is_create && el_form.reset();
            if (is_create)
                emit('hide');
        },
    })
}

</script>
