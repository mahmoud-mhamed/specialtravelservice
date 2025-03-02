<script setup>
import GaugeChart from "@/Components/Charts/GaugeChart.vue";

defineProps({
    title: String,
    value: Number,
    icon: String,
    classes: String,
    color: String,
    label: String,
    count: Number,
})
</script>

<template>
    <div class="w-full aspect-square rounded-lg text-secondary-500 bg-white" :class="classes">
        <div class="flex flex-col justify-between h-full">
            <div v-text="title" class="text-xl font-bold p-6"/>
            <div class="flex flex-col gap-2 w-full justify-center items-center">
                <span class="text-6xl font-bold" v-text="count" />
                <span class="text-3xl" v-text="label" />
            </div>
            <GaugeChart :value="value" :color="color" />
        </div>
    </div>
</template>

