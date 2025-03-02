<template>
    <ElHeader>
        <template #header>
            <div class="flex">
                <AvatarProfile :label="usePage().props?.profile_row.name" :url="usePage().props?.profile_row.avatar_url"/>
                <aside>
                    <p class="font-bold text-xl">{{ usePage().props?.profile_row['name'] }}</p>
                    <p>{{$t('column.email')}} : <ElText :value="usePage().props?.profile_row.email"/></p>
                </aside>
            </div>
        </template>
        <template #tabs>
            <Tabs :label="$t('message.main_data')" v-ability="Ability.M_USERS_MAIN_DATA" :href="route('dashboard.users.profile.main_data',usePage().props?.profile_row.id)"/>
            <Tabs :label="$t('message.edit')" v-ability="Ability.M_USERS_UPDATE" :href="route('dashboard.users.profile.edit',usePage().props?.profile_row.id)"/>
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

</script>
