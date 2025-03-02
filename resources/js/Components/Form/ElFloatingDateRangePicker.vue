<template>
    <aside class="relative">
        <FloatLabel>
            <DatePicker v-model="tempDate" selectionMode="range" :manualInput="false"
                        dateFormat="yy-mm-dd" @date-select="handleDate"
                       class="w-full" :class="{'p-invalid':hasError()}"
                        v-bind="$attrs"/>
            <i @click="clear" class="p-dropdown-clear-icon pi pi-times absolute left-1 top-2.5 cursor-pointer"
               :class="{'!hidden': !form[name]}"></i>
            <label>
                {{ label ?? $t('column.' + name) }}
                <SpanRequired v-if="required"/>
            </label>
        </FloatLabel>
        <ElTextError v-if="hasError()" :value="form['errors'][name]"/>
    </aside>
</template>

<script setup>
import SpanRequired from "@/Components/Form/ElSpanRequired.vue";
import FloatLabel from "primevue/floatlabel";
import ElTextError from "@/Components/Text/ElTextError.vue";
import DatePicker from 'primevue/datepicker';
import {ref, watch} from "vue";
import {useDateFormat} from "@vueuse/core";

const props = defineProps({
    label: String,
    name: String,
    form: Object,
    required: {
        type: Boolean,
        default: false
    }
})
const rangeDate = ref({
    fromDate: null,
    toDate: null
});
const emit = defineEmits(['change'])

const tempDate = ref(null);
if (props.form[props.name]){
    let query_value = props.form[props.name].split(" - ");
    tempDate.value = [
        query_value[0] ? new Date(query_value[0]) : null,
        query_value[1] ? new Date(query_value[1]) : null,
    ];
}
function handleDate(date) {
    rangeDate.value.fromDate=tempDate.value[0]?useDateFormat(tempDate.value[0], 'YYYY-MM-DD').value:null;
    rangeDate.value.toDate=tempDate.value[1]?useDateFormat(tempDate.value[1], 'YYYY-MM-DD').value:null;
    if (rangeDate.value.toDate && rangeDate.value.fromDate) {
        props.form[props.name] =  rangeDate.value.fromDate+' - '+rangeDate.value.toDate;
        emit('change', props.form[props.name])
    }
}
function clear() {
    tempDate.value = null;
    props.form[props.name] = null;
    emit('change', props.form[props.name])
}
const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;
</script>

<style scoped>

</style>
