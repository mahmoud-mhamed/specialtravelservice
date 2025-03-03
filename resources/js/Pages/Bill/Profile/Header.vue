<template>
    <ElHeader>
        <template #header>
            <div class="flex flex-col gap-2">
                <ElLabelValueText :value="usePage().props?.profile_row.id" :label="$t('column.id')"/>
                <ElLabelValueText :value="usePage().props?.profile_row.client_name" :label="$t('column.client_name')"/>
                <ElLabelValueText :value="usePage().props?.profile_row.status_text" :label="$t('column.status')"/>
                <ElLabelValuePrice :value="usePage().props?.profile_row.price"
                                   :label="$t('message.price')"/>
            </div>
        </template>
        <template #tabs>
            <Tabs :label="$t('message.main_data')"
                  :href="route('dashboard.bill.profile.main_data',usePage().props?.profile_row.id)"/>
        </template>
    </ElHeader>
</template>
<script setup>
import ElHeader from "@/Components/Profile/ElHeader.vue";
import Tabs from "@/Components/Profile/ElTabs.vue";
import {usePage} from "@inertiajs/vue3";
import ElLabelValueText from "@/Components/Text/ElLabelValueText.vue";
import ElLabelValuePrice from "@/Components/Text/ElLabelValuePrice.vue";
</script>
