<template>
    <ElChart v-if="chart?.data" :type="chart?.type" :data="data" :options="options" :height="height"/>
</template>

<script setup>
import {onMounted, ref} from "vue";
import ElChart from "./ElChart.vue";
import {Chart as dChart} from 'chart.js'
import ChartDataLabels from 'chartjs-plugin-datalabels';

const props = defineProps({
    chart: Object,
    height: {
        type: Number,
        default: 200
    }
})
const options = ref({...props.chart?.options});
const data = ref({...props.chart?.data});
onMounted(() => {
    dChart.defaults.font = {...props.chart?.defaults?.font};
    if(props.chart?.options?.plugins?.datalabels?.display) {
        dChart.register(ChartDataLabels);
    }
})

</script>

<style scoped>

</style>
