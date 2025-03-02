<template>
    <component :is="$attrs.href?(initA?'a':'Link'):'label'" class="text-gray-700 dark:text-primary_web-100 block">
        <Button type="button" :label="text" :iconPos="usePage().props?.lang?.current==='ar'?'right':'left'" :icon="icon" class="p-button-text p-button-plain w-full" style="justify-content: start"/>
    </component>
</template>

<script setup>
import Button from "primevue/button";
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    text: null,
    icon: null,
    initA: {type: Boolean, default: false}
})
</script>
<style scoped>

</style>
