<template>

    <aside class="floating-price-input">
        <FloatLabel>

            <DatePicker
                v-model="form[name]"
                :manualInput="false"
                iconDisplay="input"
                dateFormat="yy/mm/dd"
                showButtonBar
                showIcon
                fluid
                @update:model-value="formatDate"
                class="w-full"
                :class="{'p-invalid':hasError()}"
                v-bind="$attrs"
                pt:title="!order-none !w-full !justify-center"
            />

            <label>
                {{ label ?? $t('column.' + name) }}
                <SpanRequired v-if="required"/>
            </label>

        </FloatLabel>

        <ElTextError
            v-if="hasError()"
            :value="form['errors'][name]"
        />

    </aside>

</template>

<script setup>

import SpanRequired from "@/Components/Form/ElSpanRequired.vue";
import FloatLabel from "primevue/floatlabel";
import ElTextError from "@/Components/Text/ElTextError.vue";
import DatePicker from 'primevue/datepicker';

const props = defineProps({
    label: String,
    name: String,
    form: Object,
    required: {
        type: Boolean,
        default: false
    }
})

const formatDate = (value) => {
    if (!value) {
        // If the value is null or empty, clear the date
        props.form[props.name] = null;
    } else {
        // Format the date as before
        let date = new Date(value);
        const offset = date.getTimezoneOffset();
        date = new Date(date.getTime() - (offset * 60 * 1000));
        props.form[props.name] = date.toISOString().split('T')[0];
    }
}

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;

</script>
