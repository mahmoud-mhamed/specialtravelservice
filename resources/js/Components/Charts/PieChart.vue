<template>
    <div class="card flex justify-content-center">
        <Chart type="polarArea" :data="chartData" :options="chartOptions" class="w-full md:w-30rem"/>
    </div>
</template>

<script setup>
import Chart from 'primevue/chart';
import {ref, onMounted} from "vue";

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});
const props = defineProps({
    data: {
        type: Array,
        default: {}
    },
    total: {
        type: String,
        default: null
    }
})
const originalData = props.data;
const chartData = ref();
const chartOptions = ref();
const setChartData = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    var data = [];
    var colors = [];
    var trans = [];

    for (let index = 0; index < originalData.length; index++) {
        data.push(originalData[index]['count']);
        colors.push(documentStyle.getPropertyValue('--' + originalData[index]['color'] + '-500'));
        trans.push(originalData[index]['trans']);

    }

    return {
        datasets: [
            {
                data: data,
                backgroundColor: colors,
                label: props.total
            }
        ],
        labels: trans
    };
};
const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--text-color');
    const surfaceBorder = documentStyle.getPropertyValue('--surface-border');

    return {
        plugins: {
            legend: {
                labels: {
                    color: textColor
                }
            }
        },
        scales: {
            r: {
                grid: {
                    color: surfaceBorder
                }
            }
        }
    };
}
</script>
