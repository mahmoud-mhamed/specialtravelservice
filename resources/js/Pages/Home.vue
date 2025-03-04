<script setup>

import ElPanel from "@/Components/Main/ElPanel.vue";
import ElDataStatisticCard from "@/Components/Card/ElDataStatisticCard.vue";
import ElChartCard from "@/Components/Charts/ElChartCard.vue";

const props = defineProps({
    data: {type: Object},
});
</script>

<template>
    <ElPanel>
        <section class="grid gap-8">
            <aside class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <ElDataStatisticCard :data="data.users"/>
                <ElDataStatisticCard :data="data.bills"/>
            </aside>
        </section>
    </ElPanel>
</template>

<style scoped>

</style>
