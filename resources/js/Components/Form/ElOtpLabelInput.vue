<template>
    <aside>
        <p>
            {{ label ?? $t('column.' + name) }}
            <ElTextRequired v-if="required"/>
        </p>
        <InputOtp integerOnly dir="ltr" class="flex !gap-3" v-model="form[name]" :disabled="processing || form.processing"
                  :class="{'p-invalid':hasError(),'active_otp':form[name]}" @update:modelValue="value => updateValue(value)">
            <template #default="{attrs, events, index}">
                <InputText v-bind="attrs" v-on="events" class="text-center"
                :autofocus="index === 1"
                           :class="{'!bg-slate-100': index <= otpLength}"
                />
            </template>
        </InputOtp>
        <ElTextError v-if="hasError()" :value="customError??form['errors'][name]"/>
    </aside>
</template>

<script setup>
import ElTextRequired from "@/Components/Text/ElTextRequired.vue";
import ElTextError from "@/Components/Text/ElTextError.vue";
import InputOtp from 'primevue/inputotp';
import InputText from 'primevue/inputtext';
import {ref} from "vue";

const props = defineProps({
    label: String,
    name: String,
    form: Object,
    customError: {
        type: Object,
        default: null,
    },
    processing: {
        type: Boolean,
        default: false
    },
    required: {
        type: Boolean,
        default: false
    },
})
const emit = defineEmits(['complete']);
const otpLength = ref(0);
const updateValue = (value) => {
    otpLength.value = value.length;
    if(value.length === 4) {
        emit('complete', value);
    }
}
const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : !!props.customError;
</script>


