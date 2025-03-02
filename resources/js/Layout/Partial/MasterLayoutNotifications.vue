<template>
    <div class="flex items-center mr-1 leading-5 box-border text-slate-900">


        <Sidebar v-model:visible="notificationsShow" key="notifications_aside">
            <h1 class="mb-1">{{ $t('notifications') }}</h1>


            <div v-if="notifications.length" v-for="notification in notifications" class="border p-3 mt-2">
                <Link v-if="notification.data.url" :href="notification.data.url"
                      class="text-primary-500 mb-1 text-md font-semibold hover:text-blue-500">
                    {{ notification.data.message }}
                </Link>

                <p v-else class="text-primary-500 mb-1 text-md font-semibold">
                    {{ notification.data.message }}
                </p>

                <div class="flex justify-between text-slate-400 text-sm">
                    <p>{{ notification.created_by_name }}</p>
                    <p>{{ notification.created_at }}</p>
                </div>
            </div>


            <template v-if="showProgress">
                <ProgressSpinner/>
            </template>

        </Sidebar>
        <Sidebar v-model:visible="notificationsMessageShow" key="notifications_aside_messages">
            <h1 class="mb-1">{{ $t('base.messages') }}</h1>


            <div v-if="messages_notifications.length" v-for="notification in messages_notifications"
                 class="border p-3 mt-2">
                <Link v-if="notification.data.url" :href="notification.data.url"
                      class="text-primary-500 mb-1 text-md font-semibold hover:text-blue-500">
                    {{ notification.data.message }}
                </Link>

                <p v-else class="text-primary-500 mb-1 text-md font-semibold">
                    {{ notification.data.message }}
                </p>

                <div>
                    <p>{{ notification.created_at }}</p>
                </div>
            </div>


            <template v-if="showProgress">
                <ProgressSpinner/>
            </template>

        </Sidebar>
        <div class="notifications-btn">
            <div
                class="bg-gray-50  ml-2 dark:bg-slate-500/20 cursor-pointer inline-flex relative justify-center items-center p-0 w-10 h-10 text-lg font-medium text-center rounded-lg"
                @click="notificationsMessageShow = true">
                <i class="pi pi-comments text-primary-500 dark:text-primary-300"></i>
                <label v-if="$page.props.unread_message_count > 0"
                       class="bg-red-600 text-white pt-1 block absolute -top-2 -left-3  px-1 pt-1 grid place-content-center aspect-square rounded-full">
                    <span class="block p-0.5 text-sm !leading-[0]">
                        {{
                            $page.props.unread_message_count > 99 ? 99 : $page.props.unread_message_count
                        }}
                    </span>
                </label>
            </div>
        </div>
        <div class="notifications-btn">
            <div
                class="bg-gray-50  dark:bg-slate-500/20 cursor-pointer inline-flex relative justify-center items-center p-0 w-10 h-10 text-lg font-medium text-center rounded-lg"
                @click="notificationsShow = true">
                <i class="pi pi-bell text-primary-500 dark:text-primary-300"></i>
                <span v-if="$page.props.unread_notifications_count > 0"
                      class="bg-red-600 text-white pt-1 block absolute -top-2 -left-3  px-1 pt-1 grid place-content-center aspect-square rounded-full">
               <span class="block p-0.5 text-sm !leading-[0]">{{
                       $page.props.unread_notifications_count > 99 ? 99 : $page.props.unread_notifications_count
                   }}</span>
            </span>
            </div>
        </div>
    </div>
</template>
<script setup>
import Sidebar from 'primevue/sidebar';
import {ref, watch} from "vue";
import ProgressSpinner from 'primevue/progressspinner';
import {router} from "@inertiajs/vue3";

let notifications = ref([]);
let messages_notifications = ref([]);
let notificationsShow = ref(false);
let notificationsMessageShow = ref(false);
let showProgress = ref(true);

watch(notificationsShow, val => {
    router.reload();
    if (val) {
        axios.get('/module/notifications').then(response => {
            notifications.value = response.data.notifications;
            showProgress.value = false;
        });
    } else {
        notifications.value = [];
        showProgress.value = true;
    }
});
watch(notificationsMessageShow, val => {
    router.reload();
    if (val) {
        axios.get('/module/notifications/messages').then(response => {
            messages_notifications.value = response.data.notifications;
            showProgress.value = false;
        });
    } else {
        messages_notifications.value = [];
        showProgress.value = true;
    }
});

</script>
<style>

@keyframes p-progress-spinner-color {
    100%,
    0% {
        stroke: #ce8e54;
    }
    40% {
        stroke: #ce8e54;
    }
    66% {
        stroke: #ce8e54;
    }
    80%,
    90% {
        stroke: #ce8e54;
    }
}

</style>
