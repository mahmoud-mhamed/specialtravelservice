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
import ElRouteClientProfile from "@/Components/ElRoutes/ElRouteClientProfile.vue";
import ClientFormCreateUpdate from "@/Pages/Client/ClientFormCreateUpdate.vue";

const props = defineProps({
    data: Object,
})
const showDialogCreateUpdate = ref(false);
const edit_row = ref();
</script>

<template>
    <ElPanel>
        <template #actions>
            <el-primary-button @click="edit_row=null;showDialogCreateUpdate=true" v-ability="Ability.M_CLIENT_STORE"
                               :text="$t('message.add_new')"/>
        </template>
        <ElDataTable :src="props.data.rows">
            <Column :header="$t('column.name')">
                <template #body="row">
                    <ElRouteClientProfile :model="row.data"/>
                </template>
            </Column>
            <Column :header="$t('column.phone')">
                <template #body="row">
                    <ElText :value="row.data.phone"/>
                </template>
            </Column>
            <Column :header="$t('column.national_id')">
                <template #body="row">
                    <ElText :value="row.data.national_id"/>
                </template>
            </Column>
            <Column field="updated_at_text" :header="$t('column.updated_at')"/>
            <Column :header="$t('message.actions')">
                <template #body="row">
                    <ElActionMenu>
                        <ElActionMenuEdit v-ability="Ability.M_CLIENT_EDIT"
                                          @click="edit_row=row.data;showDialogCreateUpdate=true"/>
                        <ElActionMenuDeleteAction v-ability="Ability.M_CLIENT_DELETE"
                                                  :dialog-message="row.data.name"
                                                  :href="route('dashboard.client.delete',row.data.id)"/>
                    </ElActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
    <Dialog v-model:visible="showDialogCreateUpdate" :style="{width: '50rem'}"
            :header="edit_row?$t('message.edit'):$t('message.add_new')"
            modal maximizable>
        <ClientFormCreateUpdate :form_data="data.form_data" :row="edit_row" @hide="showDialogCreateUpdate=false"/>
    </Dialog>
</template>

<style scoped>

</style>
