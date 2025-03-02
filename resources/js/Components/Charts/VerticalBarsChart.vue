<template>
    <div ref="chartContainer" class="chart-container flex justify-center items-center mx-auto my-8 w-full">
        <svg :width="totalWidth" height="200" class="overflow-visible">
            <!-- رسم الأعمدة -->
            <g v-for="(height, index) in barHeights" :key="index"
               :transform="`translate(${index * (barWidth + gap)}, 0)`">
                <!-- الخلفية تمتد لطول 100% -->
                <rect
                    y="0"
                    :width="barWidth"
                    height="200"
                    class="fill-neutral-100"
                    rx="10"
                    ry="10"
                />
                <!-- العمود -->
                <rect
                    :y="200 - height * 2"
                    :width="barWidth"
                    :height="height * 2"
                    class="fill-secondary-200 hover:fill-secondary-500"
                    rx="10"
                    ry="10"
                />
                <!-- النص أسفل العمود -->
                <text
                    :x="barWidth / 2"
                    y="215"
                    text-anchor="middle"
                    class="text-xs fill-secondary-500"
                >
                    {{ labels[index] }}
                </text>
            </g>
        </svg>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

// البيانات التي ستظهر في الرسم البياني (12 شهرًا)
const data = [65, 59, 80, 81, 56, 55, 72, 88, 95, 60, 50, 77];
const labels = [
    'يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
    'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
];

// مراجع لعناصر DOM
const chartContainer = ref(null);
const totalWidth = ref(1000); // القيمة الافتراضية
const gapRatio = 0.4; // يمكنك تعديل هذه القيمة حسب التصميم

// تحديث عرض الرسم البياني بناءً على عرض الحاوية
const updateTotalWidth = () => {
    if (chartContainer.value) {
        totalWidth.value = chartContainer.value.offsetWidth;
    }
};

// حساب عرض العمود والفجوة بناءً على المساحة المتوفرة
const barWidth = computed(() => {
    const totalBars = labels.length;
    const totalGaps = totalBars - 1;
    return Math.min(15, totalWidth.value / (totalBars + gapRatio * totalGaps));
});

const gap = computed(() => {
    const totalBars = labels.length;
    const totalGaps = totalBars - 1;
    return (totalWidth.value - (barWidth.value * totalBars)) / totalGaps;
});

// حساب الحد الأقصى للقيمة لتحديد نسبة الأعمدة
const maxValue = Math.max(...data);

// إنشاء النسب المئوية لكل عمود بناءً على القيمة القصوى
const barHeights = computed(() => {
    return data.map((value) => (value / maxValue) * 100);
});

onMounted(() => {
    updateTotalWidth();
    window.addEventListener('resize', updateTotalWidth);
});
</script>

<style scoped>
.chart-container {
    width: 100%; /* يجعل الرسم البياني متجاوبًا مع عرض الشاشة */
}
</style>
