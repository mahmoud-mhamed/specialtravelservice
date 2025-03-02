<template>
    <ElPanel>
        <template #actions>
            <ElPrimaryButton :text="$t('message.add')" v-ability="Ability.M_ROLES_STORE"
                             :href="route('dashboard.roles.create')"/>
            <ElActionMenu>
                <ElActionMenuExportExcel :ability="Ability.M_USERS_INDEX_EXPORT"/>
            </ElActionMenu>
        </template>

        <ElDataTable :src="props.data">
            <Column :header="$t('message.role')">
                <template #body="row">
                    <ElRouteRoleProfile :model="row.data"/>
                </template>
            </Column>
            <Column :header="$t('message.abilities_count')">
                <template #body="row">
                    <ElText :value="row.data.abilities_count"/>
                </template>
            </Column>
            <Column :header="$t('message.users_count')">
                <template #body="row">
                    <ElText :value="row.data.users_count"/>
                </template>
            </Column>
            <Column :header="$t('message.actions')">
                <template #body="row">
                    <ElActionMenu>
                        <ElActionMenuEdit :ability="Ability.M_ROLES_EDIT"
                                          :href="route('dashboard.roles.edit',row.data.id)"/>
                        <ElActionMenuDeleteAction :ability="Ability.M_ROLES_DELETE" :dialog-message="row.data.title"
                                                  :href="route('dashboard.roles.delete',row.data.id)"/>
                    </ElActionMenu>
                </template>
            </Column>
        </ElDataTable>

    </ElPanel>
</template>

<script setup>
import ElPrimaryButton from '@/Components/Buttons/ElPrimaryButton.vue';
import ElDataTable from "@/Components/Table/ElDataTable.vue";
import Column from 'primevue/column';
import {Ability} from "@/ability.js";
import ElActionMenu from "@/Components/ActionMenu/ElActionMenu.vue";
import ElActionMenuEdit from "@/Components/ActionMenu/ElActionMenuEdit.vue";
import ElActionMenuExportExcel from "@/Components/ActionMenu/ElActionMenuExportExcel.vue";
import ElActionMenuDeleteAction from "@/Components/ActionMenu/ElActionMenuDeleteAction.vue";
import ElRouteRoleProfile from "@/Components/ElRoutes/ElRouteRoleProfile.vue";


const props = defineProps({
    data: Object,
})
</script>

<style scoped>

</style>
