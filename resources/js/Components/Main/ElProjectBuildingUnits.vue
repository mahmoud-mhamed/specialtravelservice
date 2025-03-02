<template>
    <div class="grid grid-cols-3 mt-2 gap-4">
        <ElFloatingDropdown :form="form" name="project_id" required :options="formData?.form_data?.projects"
                            @change="buildingsByProjectId"/>
        <ElFloatingDropdown :form="form" name="building_id" required :options="buildingsData"
                            @change="unitsByBuildingId" :label="$t('column.building')"/>
        <ElFloatingDropdown :form="form" name="unit_id" required :options="unitsData"
                            @change="unitsByBuildingId"/>
    </div>
</template>

<script setup>
import {ref} from "vue";
import ElFloatingDropdown from "@/Components/Form/ElFloatingDropdown.vue";

let formData = ref([]);
let buildingsData = ref([]);
let unitsData = ref([]);

const formOptions = async () => {
    axios.get(route('dashboard.discounts.create-update-data')).then(response => {
        formData.value = response.data;
    });
}
formOptions();
const props = defineProps({
    form: Object,
    isCreate: {
        type: Boolean,
        default: true
    },
})

const buildingsByProjectId = async () => {
    if (!props?.form.project_id) {
        buildingsData.value = null;
        unitsData.value = null;
    }
    axios.get(route('dashboard.discounts.project-buildings', props?.form.project_id)).then(response => {
        buildingsData.value = response.data.buildings;
    });
}

const unitsByBuildingId = async () => {
    if (!props?.form.building_id) {
        unitsData.value = null;
    }
    axios.get(route('dashboard.discounts.building-units', props?.form.building_id)).then(response => {
        unitsData.value = response.data.units;
    });
}

if (!props?.isCreate && props?.form?.project_id){
    buildingsByProjectId();
    unitsByBuildingId();
}
</script>

<style scoped>

</style>
