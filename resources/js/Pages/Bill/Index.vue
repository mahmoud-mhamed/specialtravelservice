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
import ElActionMenuItem from "@/Components/ActionMenu/ElActionMenuItem.vue";
import {copy} from "@/Helpers/Functions.js";
import {Enum} from "@/enum.js";
import {useI18n} from "vue-i18n";
import {useToast} from "primevue";
import ElSecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";
import {usePage} from "@inertiajs/vue3";
import Dialog from "primevue/dialog";

const props = defineProps({
    data: Object,
});

const {t} = useI18n();
const toast = useToast();
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
                    <div class="flex gap-2 items-center">
                        <ElText :value="row.data.status_text"/>
                        <ElSecondaryButton
                            v-if="usePage().props.auth.user.id===1 && row.data.status===Enum.BillStatusEnum.IN_PAY"
                            :href="route('dashboard.bill.mark-payed',row.data.id)"
                            :text="$t('message.mark_paid')"/>
                    </div>
                </template>
            </Column>
            <Column :header="$t('column.notes')">
                <template #body="row">
                    <ElText :value="row.data.notes"/>
                </template>
            </Column>
            <Column field="created_at_text" :header="$t('column.created_at')"/>
            <Column field="created_at_text" :header="$t('column.payment_data')">
                <template #body="row">
                   <div class="flex gap-2 flex-col" v-if="row.data.payment_link && row.data.status===Enum.BillStatusEnum.IN_PAY">
                       <div>
                           <ElSecondaryButton @click="copy(row.data.payment_link,toast,t)" class="cursor-pointer">
                               {{ $t('message.copy_payment_link') }}
                           </ElSecondaryButton>
                       </div>
                       <div>
                           <ElSecondaryButton @click="copy(route('visitor.bill.pay',row.data.id),toast,t)" class="cursor-pointer">
                               {{ $t('message.copy_payment_link_with_terms_conditions') }}
                           </ElSecondaryButton>
                       </div>
                   </div>
                </template>
            </Column>
            <Column :header="$t('message.actions')">
                <template #body="row">
                    <ElActionMenu>
                        <template v-if="row.data.status==='pending'">
                            <ElActionMenuItem :href="route('dashboard.bill.make-payment-link',row.data.id)"
                                              :text="$t('message.make_payment_link')"/>
                            <ElActionMenuEdit :href="route('dashboard.bill.edit',row.data.id)"/>
                            <ElActionMenuDeleteAction :dialog-message="'# '+row.data.id"
                                                      :href="route('dashboard.bill.delete',row.data.id)"/>
                        </template>
                        <template v-else-if="usePage().props.auth.user.id===1">
                            <ElActionMenuDeleteAction :dialog-message="'# '+row.data.id"
                                                      v-if="row.data.status !==Enum.BillStatusEnum.PAID"
                                                      :href="route('dashboard.bill.delete',row.data.id)"/>
                        </template>
                    </ElActionMenu>
                </template>
            </Column>
        </ElDataTable>
    </ElPanel>
</template>

<style scoped>

</style>
