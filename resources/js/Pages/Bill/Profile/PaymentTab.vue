<template>
    <ElContainer>
        <div class="flex mb-2 gap-3 justify-between">
            <div></div>
            <div>
                <ElPrimaryButton v-ability="'m_bill_payment_store_'+data.type"
                                 v-if="data.rent"
                                 :text="$t('message.app_payment')"
                                 @click="edit_row=null;show_dialog_bill=true"/>
            </div>
        </div>
        <ElDataTable :src="props.data.payments">
            <Column :header="$t('column.payment_date')">
                <template #body="row">
                    <ElText :value="row.data.payment_date"/>
                </template>
            </Column>
            <Column :header="$t('column.paid_amount') + ' - '+$t('column.paid_currency_id')">
                <template #body="row">
                    <ElPrice :value="row.data.paid_amount" :currency="row.data.paid_currency"/>
                </template>
            </Column>
            <Column :header="$t('column.bill_currency_equal_value')">
                <template #body="row">
                    <ElPrice :value="row.data.bill_currency_equal_value" :currency="data.row.currency"/>
                </template>
            </Column>
            <Column :header="$t('column.paid_amount')">
                <template #body="row">
                    <ElPrice :value="row.data.bill_currency_equal_total" :currency="data.row.currency"/>
                </template>
            </Column>
            <Column :header="$t('column.note')">
                <template #body="row">
                    <ElText :value="row.data.note"/>
                </template>
            </Column>
            <Column :header="$t('column.proof_archive_id')">
                <template #body="row">
                    <ArchiveCard v-if="row.data.proof_archive" :archive="row.data.proof_archive"/>
                    <ElText v-else/>
                </template>
            </Column>
            <Column field="created_at_text" :header="$t('column.created_at')"/>
            <Column :header="$t('message.actions')">
                <template #body="row">
                    <ElActionMenu>
                        <ElActionMenuEdit v-ability="'m_bill_payment_update_'+data.type"
                                          @click="edit_row=row.data;show_dialog_bill=true"/>
                        <ElActionMenuDeleteAction v-ability="'m_bill_payment_delete_'+data.type"
                                                  :el-id="row.data.id"
                                                  :href="route('dashboard.bill-payment.delete-payment-bill',row.data.id)"/>
                    </ElActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElContainer>

    <Dialog v-model:visible="show_dialog_bill" :style="{width: '50rem'}"
            :header="edit_row?$t('message.edit'):$t('message.add_new')"
            modal maximizable>
        <BillPaymentFormCreateUpdate :type="data.type" :bill_id="data.row.id" :form_data="data.form_data"
                                     :row="edit_row" @hide="show_dialog_bill=false"/>
    </Dialog>
</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";
import ElActionMenu from "@/Components/ActionMenu/ElActionMenu.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import ElActionMenuDeleteAction from "@/Components/ActionMenu/ElActionMenuDeleteAction.vue";
import Column from "primevue/column";
import ElPrice from "@/Components/Text/ElPrice.vue";
import ArchiveCard from "@/Components/Archive/ArchiveCard.vue";
import ElPrimaryButton from "@/Components/Buttons/ElPrimaryButton.vue";
import {ref} from "vue";
import ElActionMenuEdit from "@/Components/ActionMenu/ElActionMenuEdit.vue";
import Dialog from "primevue/dialog";
import BillPaymentFormCreateUpdate from "@/Pages/Bill/Profile/BillPaymentFormCreateUpdate.vue";

const props = defineProps(['data']);

const show_dialog_bill = ref(false);
const edit_row = ref();
</script>
