<template>

    <aside class="floating-price-input">
        <FloatLabel>
            <InputNumber
                :disabled="processing || form.processing"
                :class="{'p-invalid':hasError()}"
                v-model="form[name]"
                mode="decimal" :maxFractionDigits="5"
                :suffix="' ' + (currency?.code??'')"
                fluid
                showButtons
                buttonLayout="horizontal"
                v-bind="$attrs"
            />

            <label>
                {{ label ?? $t('column.' + name) }}
                <SpanRequired v-if="required"/>
            </label>

        </FloatLabel>

        <ElTextError
            v-if="hasError()"
            :value="customError??form['errors'][name]"
        />

    </aside>

</template>

<script setup>

import FloatLabel from 'primevue/floatlabel';
import InputNumber from 'primevue/inputnumber';
import ElTextRequired from "@/Components/Text/ElTextRequired.vue";
import ElTextError from "@/Components/Text/ElTextError.vue";
import SpanRequired from "@/Components/Form/ElSpanRequired.vue";

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
    currency: {
        type: Object,
        default: null
    },
})

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : !!props.customError;

const emit = defineEmits(['update:modelValue'])

const updateValue = (event) => {
    emit('update:modelValue', event.target.value)
}

</script>
