<template>

    <Menubar
        :model="$page.props.menu"
        class="!pb-0"
        :pt="{
            submenu: '!z-[99999]',
        }"
    >
        <template #start>
            <ElSearchInput v-if="$page.props.allowSearch"/>
        </template>
        <template #item="{ item, props, hasSubmenu, root }">

        </template>

        <template #end>
            <div
                class="flex space-x-2 pb-2 space-x-reverse flex-shrink-0 justify-center items-center content-center leading-5 text-slate-900">
                <Popover ref="ref_popover" style="width: max-content" :breakpoints="{'960px': '75vw'}">
                    <UserMenu/>
                </Popover>
                <!--                <MasterLayoutNotifications/>-->
                <div
                    class="flex space-x-2 space-x-reverse items-center bg-gray-50 dark:bg-slate-500/20 py-1 px-1.5 rounded-lg cursor-pointer text-slate-900 dark:text-primary-100"
                    @click="togglePopover">
                    <img :src="$page.props.auth.user?.avatar_url" class="h-8 w-8 rounded-full"/>
                    <span v-text="$page.props.auth.user?.name"/>
                    <i class="pi pi-chevron-down" style="font-size: 1rem"></i>
                </div>
            </div>
        </template>

    </Menubar>

</template>

<script setup>

import {ref} from "vue";
import {Badge, Menubar} from "primevue";
import {asset} from "@/Helpers/Functions.js";
import UserMenu from "@/Layout/Partial/UserMenu.vue";
import Popover from "primevue/popover";
import ElSearchInput from "@/Components/Form/ElSearchInput.vue";

const ref_popover = ref();
const togglePopover = (event) => {
    ref_popover.value.toggle(event);
}

</script>
