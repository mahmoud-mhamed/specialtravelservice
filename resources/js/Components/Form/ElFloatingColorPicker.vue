<template>
    <aside>
        <div class="mt-3" style="position: relative">
            <label style="position: unset; display: block">
                <slot name="label">{{ label }}</slot>
                <ElTextRequired v-if="required"/>
            </label>
            <ColorPicker :disabled="processing || form.processing" :class="{'p-invalid':hasError()}"
                         v-model="form[name]"/>
        </div>
        <ElTextError v-if="hasError()" :value="form['errors'][name]"/>
    </aside>
</template>

<script setup>
import ElTextRequired from "@/Components/Text/ElTextRequired.vue";
import ElTextError from "@/Components/Text/ElTextError.vue";
import ColorPicker from "primevue/colorpicker"

const props = defineProps({
    label: String,
    name: String,
    form: Object,
    required: {
        type: Boolean,
        default: false
    },
    processing: {
        type: Boolean,
        default: false
    }
})

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : null;
</script>

<style scoped>
</style>
