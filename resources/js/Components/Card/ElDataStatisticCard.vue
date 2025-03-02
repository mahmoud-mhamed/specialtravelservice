<script setup>
import StatisticCard from "@/Components/Card/StatisticCard.vue";

defineProps({
    data: Object,
})
</script>

<template>
    <StatisticCard v-if="data && data?.title" :title="data.title" :value="data.value" :icon="data.icon"/>
</template>

<style scoped>

</style>
