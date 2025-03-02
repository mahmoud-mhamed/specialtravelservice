<script setup>

import {asset} from "@/Helpers/Functions.js";
</script>

<template>
    <div class="flex flex-col justify-center items-center gap-4 w-full p-8 rounded-lg bg-white">
        <img :src="asset('images/data-empty.svg')" />
        <h3 class="text-xl font-bold" v-text="$t('message.data_empty_title')"/>
        <p v-text="$t('message.data_empty_description')"/>
    </div>
</template>

<style scoped>

</style>
