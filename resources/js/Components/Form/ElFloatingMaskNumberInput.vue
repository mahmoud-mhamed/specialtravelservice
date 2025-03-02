<template>
    <aside>
        <FloatLabel>
            <InputNumber
                v-bind="$attrs"
                v-model="form[name]"
                :id="name"
                class="w-full"
                :placeholder="label"
                :required="required"
                mode="decimal" maxFractionDigits="10"
                autocomplete="off"
                :disabled="processing || form.processing"
                :class="{'p-invalid':hasError()}"/>
            <label>
                {{ label ?? $t('column.' + name) }}
                <ElTextRequired v-if="required"/>
            </label>
        </FloatLabel>
        <ElTextError v-if="hasError()" :value="customError??form['errors'][name]"/>
    </aside>
</template>

<script setup>
import InputNumber from 'primevue/inputnumber';
import ElTextRequired from "@/Components/Text/ElTextRequired.vue";
import ElTextError from "@/Components/Text/ElTextError.vue";
import FloatLabel from 'primevue/floatlabel';

const props = defineProps({
    label: String,
    name: String,
    form: Object,
    required: {
        type: Boolean,
        default: false
    },
    modelValue: {
        type: String,
        default: null
    },
    customError: {
        type: Object,
        default: null,
    },
    processing: {
        type: Boolean,
        default: false
    },
})

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : !!props.customError;
const emit = defineEmits(['update:modelValue'])
</script>

<style scoped>

</style>
