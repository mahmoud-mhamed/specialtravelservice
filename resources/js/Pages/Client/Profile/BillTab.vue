<template>
    <ElContainer>
        <ElDataTable :src="props.data.bills">
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
        </ElDataTable>
    </ElContainer>


</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";
import {usePage} from "@inertiajs/vue3";
import ElLabelValueText from "@/Components/Text/ElLabelValueText.vue";
import ElModelUpdatedAtValueText from "@/Components/Text/ElModelUpdatedAtValueText.vue";
import ElLabelImage from "@/Components/Text/ElLabelImage.vue";
import {Ability} from "@/ability.js";
import ElActionMenuEdit from "@/Components/ActionMenu/ElActionMenuEdit.vue";
import ElRouteBillProfile from "@/Components/ElRoutes/ElRouteBillProfile.vue";
import ElText from "@/Components/Text/ElText.vue";
import ElActionMenuDeleteAction from "@/Components/ActionMenu/ElActionMenuDeleteAction.vue";
import Column from "primevue/column";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import ElRouteClientProfile from "@/Components/ElRoutes/ElRouteClientProfile.vue";
import ElRouteSupplierProfile from "@/Components/ElRoutes/ElRouteSupplierProfile.vue";
import ElActionMenu from "@/Components/ActionMenu/ElActionMenu.vue";

const props = defineProps(['data']);
</script>
