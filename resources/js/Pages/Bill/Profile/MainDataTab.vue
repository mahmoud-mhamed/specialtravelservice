<template>
    <ElContainer>
        <section class="grid md:grid-cols-2 gap-4 text-lg">
            <ElLabelValuePrice :currency="data.row.currency" :value="data.row.purchase_price"
                               :label="$t('column.purchase_price')"/>

            <ElLabelValuePrice :currency="data.row.currency" :value="data.row.selling_price"
                                  :label="$t('column.selling_price')"/>
            <ElLabelValueText :value="data.row.status_text" :label="$t('column.status')"/>
            <ElLabelValueText :value="data.row.car_type" :label="$t('column.car_type')"/>
            <ElLabelValueText :value="data.row.shipping_date" :label="$t('column.shipping_date')"/>
            <ElLabelValuePrice :currency="data.row.currency" :value="data.row.shipping_amount"
                               :label="$t('column.shipping_amount')"/>

            <ElLabelValueText :value="data.row.policy_number" :label="$t('column.policy_number')"/>
            <ElLabelValueText :value="data.row.purchase_type_text" :label="$t('column.purchase_type')"/>


            <ElLabelValueText :value="data.row.created_at_text" :label="$t('column.created_at')"/>
            <ElModelUpdatedAtValueText :model="data.row" :label="$t('column.updated_at')"/>

            <ElLabelValueText :value="data.row.note" :label="$t('column.notes')"/>
        </section>
    </ElContainer>


</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";
import {usePage} from "@inertiajs/vue3";
import ElLabelValueText from "@/Components/Text/ElLabelValueText.vue";
import ElModelUpdatedAtValueText from "@/Components/Text/ElModelUpdatedAtValueText.vue";
import ElLabelImage from "@/Components/Text/ElLabelImage.vue";
import ElLabelValuePrice from "@/Components/Text/ElLabelValuePrice.vue";

const props = defineProps(['data']);
</script>
