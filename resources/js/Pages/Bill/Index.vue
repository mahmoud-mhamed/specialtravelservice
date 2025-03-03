<script setup>
import ElPanel from "@/Components/Main/ElPanel.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import {Ability} from "@/ability.js";
import ElPrimaryButton from "@/Components/Buttons/ElPrimaryButton.vue";
import ElActionMenu from "@/Components/ActionMenu/ElActionMenu.vue";
import ElActionMenuDeleteAction from "@/Components/ActionMenu/ElActionMenuDeleteAction.vue";
import ElText from "@/Components/Text/ElText.vue";
import ElActionMenuEdit from "@/Components/ActionMenu/ElActionMenuEdit.vue";
import ElRouteBillProfile from "@/Components/ElRoutes/ElRouteBillProfile.vue";
import ElPrice from "@/Components/Text/ElPrice.vue";

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
            <Column :header="$t('column.client_name')">
                <template #body="row">
                    <ElText :value="row.data.client_name"/>
                </template>
            </Column>
            <Column :header="$t('column.service')">
                <template #body="row">
                    <ElText :value="row.data.service"/>
                </template>
            </Column>
            <Column :header="$t('column.price')">
                <template #body="row">
                    <ElPrice :value="row.data.price"/>
                </template>
            </Column>
            <Column :header="$t('column.status')">
                <template #body="row">
                    <ElText :value="row.data.status_text"/>
                </template>
            </Column>
            <Column :header="$t('column.notes')">
                <template #body="row">
                    <ElText :value="row.data.notes"/>
                </template>
            </Column>
            <Column field="created_at_text" :header="$t('column.created_at')"/>
            <Column :header="$t('message.actions')">
                <template #body="row">
                    <ElActionMenu>
                        <ElActionMenuEdit :href="route('dashboard.bill.edit',row.data.id)"/>
                        <ElActionMenuDeleteAction :dialog-message="'# '+row.data.id"
                                                  v-if="row.data.status=='pending'"
                                                  :href="route('dashboard.bill.delete',row.data.id)"/>
                    </ElActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
</template>

<style scoped>

</style>
