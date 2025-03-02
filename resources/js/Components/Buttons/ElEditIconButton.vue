<template>
    <component :is="$attrs.href?'Link':'span'">
        <Button icon="pi pi-pencil" class="table-action-btn p-button-info" v-bind="$attrs"/>
    </component>
</template>

<script setup>
import Button from 'primevue/button';

</script>

<style scoped>

</style>
