<template>
    <Button :ability="ability" :label="$t('message.export_excel')" icon="pi pi-upload" @click="exportExcel()"
            class="p-button-text dark:bg-gray-700 !p-button-plain dark:text-gray-300 w-full" v-bind="$attrs" style="white-space: nowrap;"/>
</template>

<script setup>
import Button from "primevue/button";
import {exportExcel} from "@/Helpers/Functions";

const props = defineProps({
    ability: {type: String, default: null}
})
</script>
<style scoped>

</style>
