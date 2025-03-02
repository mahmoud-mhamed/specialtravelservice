<script setup>
import { ref, computed } from 'vue';

// البيانات للنسب المئوية لكل قسم في الرسم البياني
const data = ref([30, 20, 25, 15, 10]); // 5 عناصر
const colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']; // ألوان العناصر
const labels = ['الفئة 1', 'الفئة 2', 'الفئة 3', 'الفئة 4', 'الفئة 5']; // تسميات العناصر

// حالة tooltip
const tooltip = ref({ visible: false, x: 0, y: 0, text: '' });
const hoveredSegment = ref(null); // لتحديد الجزء المفعّل

// الأقسام المخفية
const hiddenSegments = ref([]);

// حساب إجمالي القيم
const total = computed(() =>
    data.value.reduce((sum, value, index) =>
        hiddenSegments.value.includes(index) ? sum : sum + value, 0
    )
);

// حساب كل قسم بالنسبة إلى 360 درجة
const segments = computed(() => {
    let cumulativeValue = 0;
    return data.value.map((value, index) => {
        if (hiddenSegments.value.includes(index)) {
            return null; // تجاهل القسم المخفي
        }
        const startAngle = (cumulativeValue / total.value) * 360;
        cumulativeValue += value;
        const endAngle = (cumulativeValue / total.value) * 360;
        return {
            startAngle,
            endAngle,
            color: colors[index],
            label: labels[index],
            percentage: ((value / total.value) * 100).toFixed(1), // نسبة مئوية
        };
    }).filter(Boolean); // إزالة الأقسام المخفية
});

// إظهار وإخفاء tooltip
const showTooltip = (event, text, index) => {
    tooltip.value = {
        visible: true,
        x: event.clientX + 5, // إزاحة بسيطة لتجنب التداخل مع المؤشر
        y: event.clientY + 5,
        text,
    };
    hoveredSegment.value = index !== null ? index : -1; // تعيين الجزء المفعّل
};

const hideTooltip = () => {
    tooltip.value.visible = false;
    hoveredSegment.value = null; // إعادة الجزء المفعّل إلى null
};

// إخفاء/إظهار القسم عند الضغط على التسميات
const toggleSegment = (index) => {
    if (hiddenSegments.value.includes(index)) {
        hiddenSegments.value = hiddenSegments.value.filter(i => i !== index);
    } else {
        hiddenSegments.value.push(index);
    }
};
</script>

<template>
    <div class="donut-chart-container flex w-full gap-4 relative">
        <!-- الدائرة -->
        <div class="chart w-1/2 flex justify-center items-center">
            <svg class="responsive-chart" viewBox="0 0 100 100">
                <circle
                    cx="50"
                    cy="50"
                    r="40"
                    fill="none"
                    stroke="#f0f0f0"
                    stroke-width="10"
                />
                <g v-for="(segment, index) in segments" :key="index">
                    <circle
                        cx="50"
                        cy="50"
                        r="40"
                        fill="none"
                        :stroke="segment.color"
                        stroke-width="10"
                        stroke-linecap="round"
                        :stroke-dasharray="`${(segment.endAngle - segment.startAngle) / 360 * 251.2} 251.2`"
                        :stroke-dashoffset="`-${segment.startAngle / 360 * 251.2}`"
                        transform="rotate(-90 50 50)"
                        class="transition-all duration-500 cursor-pointer"
                        :style="{ opacity: hoveredSegment === null || hoveredSegment === index ? 1 : 0.8 }"
                        @mousemove="showTooltip($event, `${segment.label}: ${segment.percentage}%`, index)"
                        @mouseleave="hideTooltip"
                    />
                </g>

                <!-- الإجمالي داخل الدائرة -->
                <text x="50" y="48" text-anchor="middle" font-size="12" font-weight="bold" fill="#000">
                    {{ total }}
                </text>
                <text x="50" y="56" text-anchor="middle" font-size="8" fill="#333">
                    إجمالي
                </text>
            </svg>
        </div>

        <!-- التسميات -->
        <div class="labels w-1/2 flex flex-col justify-evenly md:pl-6">
            <div
                v-for="(label, index) in labels"
                :key="index"
                class="label flex items-center w-full cursor-pointer"
                @click="toggleSegment(index)"
                :class="{ 'opacity-50': hiddenSegments.includes(index) }"
            >
                <span
                    class="w-5 h-5 rounded mx-2"
                    :style="{ backgroundColor: colors[index] }"
                ></span>
                <span class="flex flex-grow justify-between">
                    <span>{{ label }}:</span>
                    <span class="font-bold">{{
                            hiddenSegments.includes(index) ? 'مخفي' : `${(data[index] / total * 100).toFixed(1)}%`
                        }}</span>
                </span>
            </div>
        </div>

        <!-- Tooltip -->
        <div v-if="tooltip.visible"
             :style="{ top: `${tooltip.y}px`, left: `${tooltip.x}px` }"
             class="absolute bg-black text-white text-xs p-2 rounded shadow-lg pointer-events-none">
            {{ tooltip.text }}
        </div>
    </div>
</template>

<style scoped>
.donut-chart-container {
    height: 100%;
}

.chart {
    max-width: 100%; /* الدائرة تتناسب مع المساحة المتاحة */
}

.responsive-chart {
    width: 100%;
    height: auto; /* يحافظ على النسبة بين العرض والارتفاع */
}

.label {
    transition: opacity 0.3s;
}

.tooltip {
    position: absolute;
    background: black;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    pointer-events: none;
    z-index: 1000;
    white-space: nowrap; /* يضمن أن النص لا ينكسر */
}
</style>
