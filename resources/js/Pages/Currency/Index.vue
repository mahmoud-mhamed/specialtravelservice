<script setup>
import ElPanel from "@/Components/Main/ElPanel.vue";
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import ElRouteUserProfile from "@/Components/ElRoutes/ElRouteUserProfile.vue";
import {Ability} from "@/ability.js";
import ElPrimaryButton from "@/Components/Buttons/ElPrimaryButton.vue";
import ElSecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";
import SvgTrueFalse from "@/Components/Svg/SvgTrueFalse.vue";
import {ref} from "vue";
import UserFormCreateUpdate from "@/Pages/Users/UserFormCreateUpdate.vue";
import Dialog from "primevue/dialog";
import {getAlignFrozen} from "@/Helpers/Functions.js";
import ElActionMenu from "@/Components/ActionMenu/ElActionMenu.vue";
import ElActionMenuExportExcel from "@/Components/ActionMenu/ElActionMenuExportExcel.vue";
import ElActionMenuDeleteAction from "@/Components/ActionMenu/ElActionMenuDeleteAction.vue";
import ElRouteRoleProfile from "@/Components/ElRoutes/ElRouteRoleProfile.vue";
import ElText from "@/Components/Text/ElText.vue";
import ElPrice from "@/Components/Text/ElPrice.vue";
import ElActionMenuEdit from "@/Components/ActionMenu/ElActionMenuEdit.vue";
import CurrencyFormCreateUpdate from "@/Pages/Currency/CurrencyFormCreateUpdate.vue";

const props = defineProps({
    data: Object,
})
const showDialogCreateUpdate = ref(false);
const edit_row = ref();
</script>

<template>
    <ElPanel>
        <template #actions>
            <el-primary-button @click="edit_row=null;showDialogCreateUpdate=true" v-ability="Ability.M_CURRENCIES_STORE"
                               :text="$t('message.add_new')"/>
        </template>
        <ElDataTable :src="props.data.rows">
            <Column :header="$t('column.currency_name')">
                <template #body="row">
                    <ElText :value="row.data.name"/>
                </template>
            </Column>
            <Column :header="$t('column.code')">
                <template #body="row">
                    <ElText :value="row.data.code"/>
                </template>
            </Column>
            <Column field="updated_at_text" :header="$t('column.updated_at')"/>
            <Column :header="$t('message.actions')">
                <template #body="row">
                    <ElActionMenu>
                        <ElActionMenuEdit v-ability="Ability.M_CURRENCIES_EDIT"
                                          @click="edit_row=row.data;showDialogCreateUpdate=true"/>
                        <ElActionMenuDeleteAction v-ability="Ability.M_CURRENCIES_DELETE"
                                                  :dialog-message="row.data.name"
                                                  :href="route('dashboard.currency.delete',row.data.id)"/>
                    </ElActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
    <Dialog v-model:visible="showDialogCreateUpdate" :style="{width: '50rem'}"
            :header="edit_row?$t('message.edit'):$t('message.add_new')"
            modal maximizable>
        <CurrencyFormCreateUpdate :row="edit_row" @hide="showDialogCreateUpdate=false"/>
    </Dialog>
</template>

<style scoped>

</style>
