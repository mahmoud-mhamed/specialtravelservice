<template>
    <div class="print:hidden text-right flex gap-3 pt-2" >
        <template v-for="(filterItem, key) in filters">
            <ElFloatingDropdown
                v-if="filterItem.type === 'dropdown' && filterItem.show && (filterItem?.data??[]).length"
                :form="filter" :name="key" :option-label="filterItem.optionLabel" :options="filterItem.data" class="flex-grow min-w-[200px] max-w-[300px]"/>

            <ElFloatingMultiSelect :option-label="filterItem.optionLabel"
                                   v-if="filterItem?.type === 'multi_select' && filterItem.show && (filterItem?.data??[]).length"
                                   :form="filter" :name="key" option-label="name" :options="filterItem.data" class="flex-grow  min-w-[200px] max-w-[300px]"/>

            <ElFloatingDateRangePicker v-if="filterItem.type === 'date_range' && filterItem.show"
                                       :form="filter" :name="key" class="flex-grow  min-w-[200px] max-w-[300px]"/>
        </template>

        <slot/>
    </div>
</template>

<script setup>
import {useQuery} from "@/Helpers/useQuery";
import {ref, watch} from "vue";
import {router} from "@inertiajs/vue3";
import ElFloatingDropdown from "../Form/ElFloatingDropdown.vue";
import ElFloatingMultiSelect from "../Form/ElFloatingMultiSelect.vue";
import ElFloatingDateRangePicker from "@/Components/Form/ElFloatingDateRangePicker.vue";

const props = defineProps({
    filters: Object,
});
const query = useQuery();
const filter = ref(initFilter(props.filters));

const emit = defineEmits(['filterChange']);

watch(filter, (data) => {
    let new_filter = {};
    for (const key in data) {
        if (data[key] != null && data[key] !== '') {
            new_filter[key] = data[key];
        }
    }
    router.get(window.location.pathname, new_filter, {
        preserveState: false,
        preserveScroll: true,
        replace: true,
    })
}, {
    deep: true
})

function initFilter(filters) {
    let queryFilters = {};
    Object.entries(filters).forEach(entry => {
        if (entry[1].type === 'multi_select') {
            const key = entry[0]
            if (entry[1].isInt) {
                queryFilters[key] = query.getArrayInt(key);
            } else {
                queryFilters[key] = query.getArray(key);
            }
        } else if (entry[1].type === 'date_range') {
            const key = entry[0];
            queryFilters[key] = query.get(entry[0]);
        } else {
            const [key, filter] = entry;
            queryFilters[key] = query.get(key, filter.isInt);
        }
    });
    return queryFilters;
}

</script>

<style>

</style>

