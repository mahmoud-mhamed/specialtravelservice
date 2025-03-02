<template>
    <el-floating-dropdown :form="el_form" :required="required" :options="countries" name="country_id"
                          option-label="name_text" @change="loadAreas"/>
    <el-floating-dropdown :form="el_form" :required="required" :options="areas" name="area_id"
                          option-label="name_text" @change="loadCities"/>
    <el-floating-dropdown :form="el_form" :required="required" @change="loadBlocks" :options="cities" name="city_id"
                          option-label="name_text"/>
    <el-floating-dropdown :form="el_form" :required="required" :options="blocks" name="block_id"
                          option-label="name_text"/>
</template>

<script setup>
import ElFloatingDropdown from "@/Components/Form/ElFloatingDropdown.vue";
import {ref} from "vue";

const props = defineProps({
    el_form: Object,
    required: {
        type: Boolean,
        default: false
    },
});
const countries = ref([]);
const areas = ref([]);
const cities = ref([]);
const blocks = ref([]);
const loadCountries = (is_create = true) => {
    if (is_create) {
        props.el_form.area_id = null;
        props.el_form.city_id = null;
        props.el_form.block_id = null;
    }
    countries.value = null;
    areas.value = null;
    cities.value = null;
    blocks.value = null;

    axios.get(route('city.counties'))
        .then(({data}) => {
            countries.value = data;
            loadAreas(is_create);
        });
}
const loadAreas = (is_create = true) => {
    if (is_create) {
        props.el_form.area_id = null;
        props.el_form.city_id = null;
        props.el_form.block_id = null;
    }
    areas.value = null;
    cities.value = null;
    blocks.value = null;
    if (!props.el_form.country_id)
        return;
    axios.get(route('city.children', {
        'parent_id': null,
        'country_id': props.el_form.country_id,
    }))
        .then(({data}) => {
            areas.value = data;
            loadCities(is_create)
        });
}
const loadCities = (is_create = true) => {
    if (is_create) {
        props.el_form.city_id = null;
        props.el_form.block_id = null;
    }
    cities.value = null;
    blocks.value = null;
    if (!props.el_form.area_id)
        return;
    axios.get(route('city.children', {
        'parent_id': props.el_form.area_id,
        'country_id': props.el_form.country_id,
    }))
        .then(({data}) => {
            cities.value = data;
            loadBlocks(is_create)
        });
}
const loadBlocks = (is_create = true) => {
    if (is_create) {
        props.el_form.block_id = null;
    }
    blocks.value = null;
    if (!props.el_form.city_id)
        return;
    axios.get(route('city.children', {
        'parent_id': props.el_form.city_id,
        'country_id': props.el_form.country_id,
    }))
        .then(({data}) => {
            blocks.value = data;
        });
}
loadCountries(false);
</script>

<style scoped>

</style>
