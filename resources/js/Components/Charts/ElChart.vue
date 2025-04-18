<template>
    <div class="p-chart h-full">
        <canvas ref="canvas" :width="width" :height="height" @click="onCanvasClick($event)"
                v-bind="canvasProps"></canvas>
        <div v-if="options?.description?.display && data.datasets.length===1 " class="flex mt-2 gap-4 flex-wrap">
            <aside v-for="(item,index) in data.labels" class="text-md border-b flex gap-2">
                <p>{{ item }} : </p>
                <ElText :zero-to-null="true" :value="getDataSetValue(index)"/>
            </aside>
            <aside class="flex gap-2 font-bold">
                <label>{{ $t('message.total') }} :</label>
                <label>
                    {{collect(data.datasets[0]?.data).sum()}}
                </label>
            </aside>
        </div>
    </div>
</template>

<script>
import {collect} from "collect.js";
import {usePage} from "@inertiajs/vue3";

export default {
    name: 'Chart',
    emits: ['select', 'loaded'],
    props: {
        type: String,
        data: null,
        options: null,
        plugins: null,
        width: {
            type: Number,
            default: 300
        },
        height: {
            type: Number,
            default: 150
        },
        canvasProps: {
            type: null,
            default: null
        }
    },
    chart: null,
    watch: {
        /*
         * Use deep watch to enable triggering watch for changes within structure
         * otherwise the entire data object needs to be replaced to trigger watch
         */
        data: {
            handler() {
                this.reinit();
            },
            deep: true
        },
        type() {
            this.reinit();
        },
        options() {
            this.reinit();
        }
    },
    mounted() {
        this.initChart();
    },
    beforeUnmount() {
        if (this.chart) {
            this.chart.destroy();
            this.chart = null;
        }
    },
    methods: {
        usePage,
        collect,
        initChart() {
            import('chart.js/auto').then((module) => {
                if (this.chart) {
                    this.chart.destroy();
                    this.chart = null;
                }

                if (module && module.default) {
                    this.chart = new module.default(this.$refs.canvas, {
                        type: this.type,
                        data: this.data,
                        options: this.options,
                        plugins: this.plugins
                    });
                }

                this.$emit('loaded', this.chart);
            });
        },
        getDataSetValue(index) {
            return this.data.datasets[0]?.data[index];
        },
        getCanvas() {
            return this.$canvas;
        },
        getChart() {
            return this.chart;
        },
        getBase64Image() {
            return this.chart.toBase64Image();
        },
        refresh() {
            if (this.chart) {
                this.chart.update();
            }
        },
        reinit() {
            this.initChart();
        },
        onCanvasClick(event) {
            if (this.chart) {
                const element = this.chart.getElementsAtEventForMode(event, 'nearest', {intersect: true}, false);
                const dataset = this.chart.getElementsAtEventForMode(event, 'dataset', {intersect: true}, false);

                if (element && element[0] && dataset) {
                    this.$emit('select', {originalEvent: event, element: element[0], dataset: dataset});
                }
            }
        },
        generateLegend() {
            if (this.chart) {
                return this.chart.generateLegend();
            }
        }
    }
};
</script>

<style>
.p-chart {
    position: relative;
}
</style>
