<template>
   <aside>
       <FloatLabel :variant="variant">
           <InputText :disabled="processing || form.processing || disabled" v-if="form && name" :type="type" :class="{'p-invalid':hasError()}" v-model="form[name]" v-bind="$attrs"/>
           <InputText v-else :value="modelValue" @input="updateValue" :type="type" :class="{'p-invalid': hasError(), 'p-filled': modelValue}" v-bind="$attrs"/>
           <label>
               {{ label ?? $t('column.' + name) }}
               <ElTextRequired v-if="required"/>
           </label>
       </FloatLabel>
       <ElTextError v-if="hasError()" :value="customError??form['errors'][name]"/>
   </aside>
</template>

<script setup>
import InputText from 'primevue/inputtext';
import ElTextRequired from "@/Components/Text/ElTextRequired.vue";
import ElTextError from "@/Components/Text/ElTextError.vue";
import FloatLabel from 'primevue/floatlabel';
const props = defineProps({
    label: String,
    name: String,
    type: {
        type: String,
        default: 'text'
    },
    form: Object,
    required: {
        type: Boolean,
        default: false
    },
    variant: {
        type: String,
        default: 'on'
    },
    modelValue: {
        type: String,
        default: null
    },
    customError:{
        type:Object,
        default:null,
    },
    processing: {
        type: Boolean,
        default: false
    },
    disabled: {
        type: Boolean,
        default: false
    }
})

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : !!props.customError;
const emit = defineEmits(['update:modelValue'])
const updateValue = (event) => {
    emit('update:modelValue', event.target.value)
}
</script>

<style scoped>
</style>
