<script setup>
import {asset} from "@/Helpers/Functions.js";
</script>

<template>
    <main class="min-h-screen flex flex-col justify-center items-center bg-gray-100 dark:bg-gray-900">
        <div>
            <img class="w-[300px] h-[300px]" :src="asset('images/logo.png')" alt="logo"/>
        </div>
        <h1 class="text-3xl mt-3">{{$t('message.bill_payed_thanks')}}</h1>
    </main>
</template>

<style scoped>

</style>
