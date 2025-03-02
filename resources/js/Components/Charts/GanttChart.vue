<script setup>
import { ref, computed, onMounted } from 'vue';

// بيانات المهام مع تواريخ البداية والنهاية ونسبة الاكتمال
const tasks = ref([
    // لم يبدأ بعد (حالة رمادي)
    { id: 1, name: 'Planning', startDate: '2025-01-20', endDate: '2025-01-25', completion: 0 },

    // قيد التنفيذ (حالة أصفر)
    { id: 2, name: 'Design', startDate: '2025-01-10', endDate: '2025-01-18', completion: 40 },

    // انتهت وغير مكتملة (حالة أحمر)
    { id: 3, name: 'Development', startDate: '2025-01-01', endDate: '2025-01-09', completion: 50 },

    // مكتملة (حالة أخضر)
    { id: 4, name: 'Testing', startDate: '2025-01-05', endDate: '2025-01-12', completion: 100 },

    // لم يبدأ بعد (حالة رمادي)
    { id: 5, name: 'Research', startDate: '2025-02-01', endDate: '2025-02-07', completion: 0 },

    // قيد التنفيذ (حالة أصفر)
    { id: 6, name: 'Implementation', startDate: '2025-01-15', endDate: '2025-01-25', completion: 20 },

    // انتهت وغير مكتملة (حالة أحمر)
    { id: 7, name: 'Monitoring', startDate: '2025-01-01', endDate: '2025-01-10', completion: 30 },

    // مكتملة (حالة أخضر)
    { id: 8, name: 'Deployment', startDate: '2025-01-08', endDate: '2025-01-15', completion: 100 },

    // قيد التنفيذ (حالة أصفر)
    { id: 9, name: 'Feedback', startDate: '2025-01-16', endDate: '2025-01-20', completion: 60 },

    // انتهت وغير مكتملة (حالة أحمر)
    { id: 10, name: 'Review', startDate: '2025-01-05', endDate: '2025-01-14', completion: 80 },
].sort((a, b) => new Date(a.startDate) - new Date(b.startDate)));

// حساب أقل تاريخ وأكبر تاريخ
const baseDates = computed(() => {
    const startDates = tasks.value.map((task) => new Date(task.startDate));
    const endDates = tasks.value.map((task) => new Date(task.endDate));
    const minDate = new Date(Math.min(...startDates)); // أقل تاريخ بداية
    const maxDate = new Date(Math.max(...endDates));   // أكبر تاريخ نهاية
    minDate.setDate(minDate.getDate() - 1); // توسيع النطاق ليوم واحد قبل البداية
    maxDate.setDate(maxDate.getDate() + 1); // توسيع النطاق ليوم واحد بعد النهاية
    return { minDate, maxDate };
});

// اختيار وحدة العرض بناءً على المدة
const displayUnit = computed(() => {
    const diffInDays = (baseDates.value.maxDate - baseDates.value.minDate) / (1000 * 60 * 60 * 24);
    if (diffInDays <= 30) {
        return 'day'; // يوم
    } else if (diffInDays <= 365) {
        return 'week'; // أسبوع
    } else {
        return 'month'; // شهر
    }
});

// توليد نطاق التواريخ بناءً على وحدة العرض
const timeline = computed(() => {
    const dates = [];
    let currentDate = new Date(baseDates.value.minDate);

    while (currentDate <= baseDates.value.maxDate) {
        dates.push(currentDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short' }));
        currentDate.setDate(currentDate.getDate() + 1); // تقدم يوم واحد لكل عمود
    }

    return dates;
});

const visibleDates = computed(() => {
    const dates = [];
    let currentDate = new Date(baseDates.value.minDate);
    const maxDate = new Date(baseDates.value.maxDate);

    if (displayUnit.value === 'day') {
        // إضافة كل يوم بين البداية والنهاية
        while (currentDate <= maxDate) {
            dates.push(currentDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short' }));
            currentDate.setDate(currentDate.getDate() + 1);
        }
    } else if (displayUnit.value === 'week') {
        // إضافة كل أسبوع بين البداية والنهاية مع تاريخ البداية والنهاية
        while (currentDate <= maxDate) {
            dates.push(currentDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short' }));
            currentDate.setDate(currentDate.getDate() + 8);
        }
        // ضمان وجود البداية والنهاية
        if (!dates.includes(baseDates.value.minDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short' }))) {
            dates.unshift(baseDates.value.minDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short' }));
        }
        if (!dates.includes(maxDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short' }))) {
            dates.push(maxDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short' }));
        }
    } else if (displayUnit.value === 'month') {
        // إضافة اسم الشهر فقط كل 4 أعمدة (كل أسبوع يمثل عمودًا)
        while (currentDate <= maxDate) {
            dates.push(currentDate.toLocaleDateString('en-GB', { month: 'short', year: 'numeric' }));
            currentDate.setMonth(currentDate.getMonth() + 1);
        }
    }

    return dates;
});

// حساب موقع وطول المهمة بناءً على التواريخ المرئية
const getTaskStyle = (task) => {
    const today = new Date();
    const startDate = new Date(task.startDate);
    const endDate = new Date(task.endDate);

    // تحديد لون TailwindCSS بناءً على حالة المهمة
    let backgroundColorClass = 'bg-gray-400'; // لون رمادي افتراضي
    if (today < startDate) {
        backgroundColorClass = 'bg-gray-400'; // رمادي: لم يبدأ
    } else if (today >= startDate && today <= endDate) {
        backgroundColorClass = 'bg-yellow-400'; // أصفر: قيد التنفيذ
    } else if (today > endDate && task.completion < 100) {
        backgroundColorClass = 'bg-red-500'; // أحمر: انتهت وغير مكتملة
    } else if (task.completion === 100) {
        backgroundColorClass = 'bg-green-500'; // أخضر: مكتملة
    }

    // حساب موقع البداية والنهاية بناءً على عدد الأيام
    const startIndex = Math.floor((startDate - baseDates.value.minDate) / (1000 * 60 * 60 * 24));
    const endIndex = Math.floor((endDate - baseDates.value.minDate) / (1000 * 60 * 60 * 24));

    // إذا كانت التواريخ خارج نطاق الخط الزمني
    if (startIndex < 0 || endIndex >= timeline.value.length) {
        console.log('Task out of timeline range:', task);
        return {};
    }

    // حساب الامتداد (عدد الأعمدة)
    const span = endIndex - startIndex + 1;

    return {
        gridColumnStart: startIndex + 1,
        gridColumnEnd: `span ${span - 1}`,
        backgroundColorClass: backgroundColorClass,
        color: 'text-white',
        padding: 'px-2',
        textAlign: 'text-center',
        position: 'relative',
        margin: 'my-1',
    };
};

// حساب موقع تاريخ اليوم
const todayIndex = computed(() => {
    const today = new Date().toLocaleDateString('en-GB', { day: 'numeric', month: 'short' });
    return timeline.value.findIndex(date => date === today) + 1;
});
</script>

<template>
    <div class="gantt-chart flex flex-col w-full max-w-[100vw] overflow-x-auto transition-all ease-in-out duration-500" dir="rtl">
        <!-- الخط الزمني -->
        <div class="timeline-container relative flex justify-between items-center w-full">
            <!-- الخط الأفقي المتصل -->
            <div class="absolute w-full h-0.5 bg-gray-300 top-2"></div>
            <div v-for="(date, index) in visibleDates" :key="index" class="relative flex flex-col items-center">
                <!-- النقطة الزمنية -->
                <div class="timeline-point w-4 h-4 bg-white border-4 border-primary-500 rounded-full z-10"></div>
                <!-- التاريخ -->
                <div class="timeline-date text-sm font-medium mt-2">{{ date }}</div>
            </div>
        </div>

        <!-- المهام -->
        <div class="gantt-container mt-4">
            <div class="gantt-body relative">
                <div class="gantt-grid absolute top-0 right-0 w-full h-full grid transition-all ease-in-out duration-500"
                     :style="{ gridTemplateColumns: displayUnit === 'month'
         ? `repeat(${timeline.length * 4}, minmax(10px, 1fr))`
         : `repeat(${timeline.length}, minmax(10px, 1fr))` }"
                >
                    <!-- خطوط عمودية لكل يوم -->
                    <div v-for="(date, index) in timeline" :key="index"
                         :class="{'!border-r-2 border-red-500': index + 1 === todayIndex, 'bg-transparent': index + 1 !== todayIndex}"
                         class="border-r border-dashed border-gray-300 h-full"></div>
                </div>

                <!-- المهام -->
                <div v-for="task in tasks" :key="task.id"
                     class="gantt-row grid gap-1 items-center transition-all ease-in-out duration-500"
                     :style="{ gridTemplateColumns: displayUnit === 'month'
         ? `repeat(${timeline.length * 4}, minmax(10px, 1fr))`
         : `repeat(${timeline.length}, minmax(10px, 1fr))` }">
                    <div class="relative text-center p-3 transform hover:scale-105 transition-all ease-in-out duration-500"
                         :class="[getTaskStyle(task).backgroundColorClass, getTaskStyle(task).color, getTaskStyle(task).padding, getTaskStyle(task).borderRadius, getTaskStyle(task).margin]"
                         :style="{ gridColumnStart: getTaskStyle(task).gridColumnStart, gridColumnEnd: getTaskStyle(task).gridColumnEnd }">
                        <div>{{ task.name }}</div>
                        <!-- حالة الاكتمال -->
                        <div class="absolute bottom-0 right-0 h-1 bg-green-500 rounded-full" :style="{ width: `${task.completion}%` }"></div>
                        <div class="text-xs mt-1">
                            {{ task.startDate }} - {{ task.endDate }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
