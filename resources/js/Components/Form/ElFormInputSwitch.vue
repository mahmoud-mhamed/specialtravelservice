<template>
    <aside>
        <Label class="flex cursor-pointer items-center">
            <ToggleSwitch :disabled="form.processing" :id="id" v-if="form && name" v-model="form[name]"
                          :class="{'p-invalid':hasError()}"/>
            <span class="ms-2 inline-block pt-1.5 select-none" v-if="!hideLabel">
                 {{ label ?? $t('column.' + name) }}
             </span>
        </Label>
    </aside>
</template>

<script setup>

import ToggleSwitch from "primevue/toggleswitch";

const props = defineProps({
    label: String,
    name: {
        type: String,
        required: true,
    },
    id: {
        type: String,
        default: null
    },
    form: {
        type: Object,
        required: true,
    },
    binary: {
        type: Boolean,
        default: true,
    },
    hideLabel: {
        type: Boolean,
        default: false,
    },
    value: {},
})

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;
</script>

<style scoped>

</style>
