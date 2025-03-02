<script setup>
defineProps({
    value: {
        type: Number,
        default: 0,
    },
    title: {
        type: String,
        default: "نسبة الإنجاز",
    },
});
</script>

<template>
    <div class="relative aspect-square">
        <svg class="w-full aspect-square" viewBox="0 0 36 36">
            <!-- الخلفية الرمادية -->
            <circle
                stroke="currentColor"
                stroke-width="3"
                fill="none"
                cx="18"
                cy="18"
                r="15.9155"
                class="text-gray-300"
            />
            <!-- دائرة التقدم -->
            <circle
                class="text-primary-300"
                :stroke-dasharray="`${(value / 100) * 100}, 100`"
                stroke-width="3"
                stroke-linecap="round"
                fill="none"
                cx="18"
                cy="18"
                r="15.9155"
            />
        </svg>
        <!-- النص -->
        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <span class="text-3xl font-bold">{{ value }}%</span>
            <span class="text-xl text-gray-500">{{ title }}</span>
        </div>
    </div>
</template>

<style scoped>
circle {
    stroke: currentColor;
    transform: rotate(-90deg); /* جعل البداية من الأعلى */
    transform-origin: center;
    transition: stroke-dasharray 0.3s ease; /* تأثير سلس */
}
</style>
