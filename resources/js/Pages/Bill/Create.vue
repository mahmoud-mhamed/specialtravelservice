<template>
    <ElPanel>
        <BillFormCreateUpdate :row="data.row" :form_data="data.form_data"/>
    </ElPanel>
</template>

<script setup>

import BillFormCreateUpdate from "@/Pages/Bill/BillFormCreateUpdate.vue";

const props = defineProps({
    data: Object,
});

</script>

<style scoped>

</style>
