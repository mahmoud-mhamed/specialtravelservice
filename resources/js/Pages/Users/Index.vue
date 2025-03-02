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

const props = defineProps({
    data: Object,
    form_data: Object,
})
const showDialogCreate = ref(false);
</script>

<template>
    <ElPanel>
        <template #actions>
            <el-primary-button class="mr-2 ml-2" :href="route('dashboard.roles.index')" v-ability="Ability.M_ROLES_INDEX"
                               :text="$t('message.roles')"/>
            <el-secondary-button @click="showDialogCreate=true" v-ability="Ability.M_USERS_STORE"
                                 :text="$t('message.add_new')"/>
            <ElActionMenu>
                <ElActionMenuExportExcel v-ability="Ability.M_USERS_INDEX_EXPORT"/>
            </ElActionMenu>
        </template>
        <ElDataTable :src="props.data.users">
            <Column :header="$t('column.name')" :alignFrozen="getAlignFrozen()" frozen>
                <template #body="row">
                    <ElRouteUserProfile :model="row.data"/>
                </template>
            </Column>
            <Column :header="$t('message.role')">
                <template #body="row">
                    <ElRouteRoleProfile :model="row.data.roles[0]"/>
                    <ElText v-if="!row.data.roles[0]"/>
                </template>
            </Column>
            <Column :header="$t('column.phone')">
                <template #body="row">
                    <ElText :value="row.data.phone"/>
                </template>
            </Column>
            <Column field="roles" :header="$t('column.is_active')">
                <template #body="row">
                    <SvgTrueFalse :value="row.data.is_active"/>
                </template>
            </Column>
            <Column field="created_at_text" :header="$t('column.created_at')"/>
            <Column :header="$t('message.actions')">
                <template #body="row">
                    <ElActionMenu>
                        <ElActionMenuDeleteAction v-ability="Ability.M_USERS_DELETE" :dialog-message="row.data.name"
                                                  :href="route('dashboard.users.delete',row.data.id)"/>
                    </ElActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
    <Dialog v-model:visible="showDialogCreate" :style="{width: '50rem'}" :header="$t('message.add_new')"
            modal maximizable>
        <UserFormCreateUpdate :form-data="form_data" @hide="showDialogCreate=false"/>
    </Dialog>
</template>

<style scoped>

</style>
