<template>
    <div></div>
<!--    <a @click="localeUpdate" class="dark:bg-gray-700 cursor-pointer flex gap-2 bg-slate-100 py-1 px-2 rounded">
        <img :src="englishLocale ? asset('images/flags/sa.png') : asset('images/flags/us.png')" alt="Flag" class="w-6"/>
        <span v-text="englishLocale ? 'AR' : 'EN'"/>
    </a>-->
</template>

<script setup>
import {router, usePage} from "@inertiajs/vue3";
import {asset} from "@/Helpers/Functions.js";

const englishLocale = usePage().props.lang.current === "en";

const localeUpdate = () => {
    router.visit(usePage().props.lang.change_url, {
        method: 'get',
        replace: false,
        preserveState: false,
        preserveScroll: false,
        only: [],
        headers: {},
        errorBag: null,
        forceFormData: false,
        onSuccess: page => {
            window.location.reload(true);
        },
    })

};

</script>
