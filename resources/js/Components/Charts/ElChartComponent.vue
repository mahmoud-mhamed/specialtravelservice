<template>
    <el-apex-chart-component v-if="chart?.series" :chart="chart"/>
    <el-chart-js-component v-if="chart?.data" :chart="chart" :height="height"/>
</template>

<script setup>
import ElApexChartComponent from "@/Components/Charts/ElApexChartComponent.vue";
import ElChartJsComponent from "@/Components/Charts/ElChartJsComponent.vue";

const props = defineProps({
    chart: Object,
    height: {
        type: Number,
        default: 200
    }
})

</script>

<style scoped>

</style>
