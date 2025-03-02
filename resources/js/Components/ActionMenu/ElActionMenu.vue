<template>

    <span class="inline-block text-start mr-3">

        <Button
            @click="toggle"
            type="button"
            class="p-button-rounded p-button-text dark:text-gray-300"
            icon="pi pi-ellipsis-v"
        />

        <Popover ref="actionMenu">
            <div class="flex flex-col">
                <slot/>
            </div>
        </Popover>

    </span>

</template>

<script setup>

import Button from "primevue/button";
import Popover from 'primevue/popover';
import {ref} from "vue";

const actionMenu = ref(null);
const toggle = (e) => actionMenu.value.toggle(e);

</script>
