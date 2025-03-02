<template>
    <ElHeader>
        <template #header>
            <div class="flex flex-col gap-2">
                <ElLabelValueText :value="usePage().props?.profile_row.name" :label="$t('column.name')"/>
                <ElLabelValueText :value="usePage().props?.profile_row.national_id" :label="$t('column.national_id')"/>
            </div>
        </template>
        <template #tabs>
            <Tabs :label="$t('message.main_data')" v-ability="Ability.M_CLIENT_PROFILE"
                  :href="route('dashboard.client.profile.main_data',usePage().props?.profile_row.id)"/>
            <Tabs :label="$t('message.bills')" v-ability="Ability.M_CLIENT_BILLS"
                  :href="route('dashboard.client.profile.view-bills',usePage().props?.profile_row.id)"/>
            <Tabs :label="$t('message.archive')" v-ability="Ability.M_CLIENT_BILLS"
                  :href="route('dashboard.client.profile.view-archive',usePage().props?.profile_row.id)"/>
        </template>
    </ElHeader>
</template>
<script setup>
import ElHeader from "@/Components/Profile/ElHeader.vue";
import Tabs from "@/Components/Profile/ElTabs.vue";
import {usePage} from "@inertiajs/vue3";
import {Ability} from "@/ability.js";
import AvatarProfile from "@/Components/Avatar/AvatarProfile.vue";
import ElText from "@/Components/Text/ElText.vue";
import ElLabelValueText from "@/Components/Text/ElLabelValueText.vue";

</script>
