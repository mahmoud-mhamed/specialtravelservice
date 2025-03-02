<template>
   <aside>
       <FloatLabel>
           <Password class="w-full" v-if="form && name" :disabled="form.processing"
                     :feedback="feedback" toggleMask escape :class="{'p-invalid':hasError()}" v-model="form[name]"/>
           <Password class="w-full" v-else
                     :feedback="feedback" toggleMask escape :class="{'p-invalid':hasError()}" v-model="form[name]"
                     :value="modelValue" @input="updateValue"/>
           <label>
               {{ label ?? $t('column.' + name) }}
               <ElTextRequired v-if="required"/>
           </label>
       </FloatLabel>
       <ElTextError v-if="hasError()" :value="form['errors'][name]"/>
   </aside>
</template>

<script setup>
import ElTextRequired from "@/Components/Text/ElTextRequired.vue";
import ElTextError from "@/Components/Text/ElTextError.vue";
import FloatLabel from 'primevue/floatlabel';
import Password from 'primevue/password';
import InputText from "primevue/inputtext";

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
    feedback: {
        type: Boolean,
        default: false
    },
})

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;
const emit = defineEmits(['update:modelValue'])
const updateValue = (event) => {
    emit('update:modelValue', event.target.value)
}
</script>

<style scoped>

</style>
