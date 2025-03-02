<template>
    <div v-if="data[name]" class="h-full" :key="name+'_'+Math.round()">
        <section class="flex relative h-full flex-col min-w-0 leading-5 break-words bg-clip-border
         bg-white dark:bg-dark-300 border-0 border-gray-100 border-solid box-border
         text-slate-900 dark:text-white p-2 rounded-md shadow ">
            <header class="flex flex-col justify-center my-2 mr-0
                text-xl font-medium break-words box-border text-slate-900 dark:text-primary-100 h-fit">
                <div class="flex flex-row my-0 mr-0 font-medium leading-5 box-border">
                    <label class="grow pl-3">
                        {{ title ?? $t('message.' + name) }}
                    </label>
                    <slot name="actions" class="flex-none"/>
                    <div class="cursor-pointer" @click="toggleFullScreen()">
                        <i class="pi pi-window-maximize"></i>
                    </div>
                </div>
            </header>
            <hr>
            <div class="h-fit flex-grow p-0 lg:p-3">
                <el-chart-component :height="height" :chart="data[name]"/>
            </div>
        </section>
        <Dialog v-if="is_full_screen" v-model:visible="is_full_screen"
                :rtl="true" maximizable2 :style="{width: '950px'}"
                :header=" title ?? $t('message.' + name)" :modal="true">
            <div class="lg:p-3">
                <el-chart-component v-if="daily_full_screen" :chart="data[name]"/>
            </div>
        </Dialog>
    </div>

</template>

<script setup>
import {ref, watch} from "vue";
import ElChartComponent from "./ElChartComponent.vue";
import Dialog from "primevue/dialog";

const props = defineProps({
    title: {type: String},
    name: {type: String},
    data: {type: String},
    height: {type: Number, default: 100},
});
const is_full_screen = ref(false);
const daily_full_screen = ref(false);
const toggleFullScreen = () => {
    is_full_screen.value = !is_full_screen.value;
}
watch(is_full_screen, (new_value) => {
    setTimeout(function () {
        daily_full_screen.value = new_value;
    }, 200)
})</script>

<style scoped>

</style>
