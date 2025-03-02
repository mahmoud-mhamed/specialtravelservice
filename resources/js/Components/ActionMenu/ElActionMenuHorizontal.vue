<template>
    <span class="inline-block text-start mr-3">
        <Button @click="toggle" type="button" class="horizontal-menu rotate-90 p-button-rounded p-button-text dark:text-gray-300" icon="pi pi-ellipsis-v"/>
        <OverlayPanel ref="actionMenu">
            <div class="flex flex-col">
                 <slot/>
            </div>
        </OverlayPanel>
    </span>
</template>

<script setup>
import Button from "primevue/button";
import OverlayPanel from 'primevue/overlaypanel';
import {ref} from "vue";

const actionMenu = ref(null);
const toggle = (e) => actionMenu.value.toggle(e);
</script>

<style scoped>

</style>
