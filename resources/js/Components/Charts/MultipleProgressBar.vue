<template>
    <div class="relative py-1">
        <div class="overflow-hidden h-5 text-base flex rounded-lg bg-slate-300">
            <div v-for="item in items" :style="`width: ${item.per}%`" class="flex flex-col
            text-center justify-start items-center whitespace-nowrap text-white font-bold"
            :class="item.color">
                <span v-if="!isNaN(item.per)" class="text-sm">{{Math.round(item.per)}}%</span>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    items: Object
})
</script>

<style scoped>

</style>
