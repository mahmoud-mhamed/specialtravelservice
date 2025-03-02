<template>
    <div
        class="flex flex-col p-0 m-0 w-full text-lg font-medium leading-5  box-border text-slate-900">
        <!-- User Card -->
        <div
            class="flex items-center py-3 px-4 text-sm font-medium leading-5 box-border text-slate-900 dark:text-primary-100 border-b border-gray-100 dark:border-dark-100"
            style="direction: rtl; list-style: outside none none;">
            <!--begin::Avatar-->
            <div class="inline-block relative flex-shrink-0 ml-3 font-medium box-border" style="direction: rtl; list-style: outside none none;">
                <Avatar :image="$page.props.auth.avatar_url" :label="!$page.props.auth.avatar ? $page.props.auth.user?.name.charAt(0).toUpperCase() : null" class="shadow  shadow-5xl ml-3" size="xlarge"/>
            </div>
            <!--end::Avatar-->

            <!--begin::Username-->
            <div
                class="flex flex-col font-medium box-border text-primary-500" style="direction: rtl; list-style: outside none none;">
                <Link>
                    <div
                        class="flex items-center text-lg font-semibold leading-6 box-border" style="direction: rtl; list-style: outside none none;">
                        {{ $page.props.auth?.user?.name }}
                    </div>
                    <a class="text-base text-gray-400 dark:text-gray-300 cursor-pointer box-border hover:text-primary-500" style="text-decoration: none; transition: color 0.2s ease 0s, background-color 0.2s ease 0s; direction: rtl; list-style: outside none none;">
                        {{ $page.props.auth?.user?.email }}
                    </a>
                </Link>
            </div>
            <!--end::Username-->
        </div>
        <!-- End User Card -->
        <div
            class="block p-0 text-sm font-medium leading-5 box-border text-slate-900"
            style="list-style: outside none none;">
            <LinkUserMenu :href="route('dashboard.logout')" method="post" :text="$t('message.logout')"/>
        </div>

    </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import Avatar from "primevue/avatar";
import LinkUserMenu from "@/Layout/Partial/LinkUserMenu.vue";
</script>

<style scoped>

</style>
