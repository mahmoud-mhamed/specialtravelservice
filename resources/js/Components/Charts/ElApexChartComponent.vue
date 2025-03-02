<template>
    <div>
        <apexchart :width="chart?.width" :height="chart?.height" :type="chart?.type" :options="options" :series="chart?.series"></apexchart>
    </div>
</template>
<script setup>
import {ref} from "vue";

const props = defineProps({
    chart: Object,
    height: {
        type: Number,
        default: 200
    }
})
const options = ref({...props.chart?.options, theme: {palette: 'palette2'}});

</script>

<style scoped>

</style>
