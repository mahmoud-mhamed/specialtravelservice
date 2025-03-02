<script setup>

import {asset} from "@/Helpers/Functions.js";

const props = defineProps({
    data: {type: Object},
});
</script>

<template>
    <section class="w-full h-[100vh] flex justify-center items-center text-4xl">
        <div>
            <img :src="asset('images/logo.png')" width="400" alt="logo"/>
            <div class="text-center mt-5">
                {{$t('message.soon')}}
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
