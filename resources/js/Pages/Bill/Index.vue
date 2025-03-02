<script setup>
import ElPanel from "@/Components/Main/ElPanel.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import {Ability} from "@/ability.js";
import ElPrimaryButton from "@/Components/Buttons/ElPrimaryButton.vue";
import {ref} from "vue";
import Dialog from "primevue/dialog";
import ElActionMenu from "@/Components/ActionMenu/ElActionMenu.vue";
import ElActionMenuDeleteAction from "@/Components/ActionMenu/ElActionMenuDeleteAction.vue";
import ElText from "@/Components/Text/ElText.vue";
import ElPrice from "@/Components/Text/ElPrice.vue";
import ElActionMenuEdit from "@/Components/ActionMenu/ElActionMenuEdit.vue";
import ElRouteSupplierProfile from "@/Components/ElRoutes/ElRouteSupplierProfile.vue";
import SupplierFormCreateUpdate from "@/Pages/Supplier/SupplierFormCreateUpdate.vue";
import ElRouteBillProfile from "@/Components/ElRoutes/ElRouteBillProfile.vue";
import ElRouteClientProfile from "@/Components/ElRoutes/ElRouteClientProfile.vue";

const props = defineProps({
    data: Object,
})
</script>

<template>
    <ElPanel>
        <template #actions>
            <el-primary-button :href="route('dashboard.bill.create')" v-ability="Ability.M_BILL_CREATE"
                               :text="$t('message.add_new')"/>
        </template>
        <ElDataTable :src="props.data.rows">
            <Column :header="$t('column.id')">
                <template #body="row">
                    <ElRouteBillProfile :model="row.data"/>
                </template>
            </Column>
            <Column :header="$t('column.supplier_id')">
                <template #body="row">
                    <ElRouteSupplierProfile :model="row.data.supplier"/>
                </template>
            </Column>
            <Column :header="$t('column.client_id')">
                <template #body="row">
                    <ElRouteClientProfile :model="row.data.client"/>
                </template>
            </Column>
            <Column :header="$t('column.disabled_client_id')">
                <template #body="row">
                    <ElRouteClientProfile :model="row.data.disabled_client"/>
                </template>
            </Column>
            <Column :header="$t('column.purchase_type')">
                <template #body="row">
                    <ElText :value="row.data.purchase_type_text"/>
                </template>
            </Column>
            <Column :header="$t('column.car_type')">
                <template #body="row">
                    <ElText :value="row.data.car_type"/>
                </template>
            </Column>
            <Column :header="$t('column.chassis_number')">
                <template #body="row">
                    <ElText :value="row.data.chassis_number"/>
                </template>
            </Column>
            <Column :header="$t('column.status')">
                <template #body="row">
                    <ElText :value="row.data.status_text"/>
                </template>
            </Column>
            <Column field="updated_at_text" :header="$t('column.updated_at')"/>
            <Column :header="$t('message.actions')">
                <template #body="row">
                    <ElActionMenu>
                        <ElActionMenuEdit v-ability="Ability.M_BILL_EDIT" :href="route('dashboard.bill.edit',row.data.id)"/>
                        <ElActionMenuDeleteAction v-ability="Ability.M_BILL_DELETE"
                                                  :dialog-message="'# '+row.data.id"
                                                  :href="route('dashboard.bill.delete',row.data.id)"/>
                    </ElActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
</template>

<style scoped>

</style>
