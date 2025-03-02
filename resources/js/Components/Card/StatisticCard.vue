<script setup>
defineProps({
    title: String,
    value: String,
    icon: String,
})
</script>

<template>
    <div class="bg-statistic w-full aspect-[18/7] rounded-lg text-primary-300">
        <div class="flex w-full h-full justify-around items-center">
            <div class="flex flex-col items-center justify-center text-2xl">
                <div class="font-bold text-6xl" v-text="value" />
                <div v-text="title" />
            </div>
            <div>
                <div class="border-4 border-primary-300 rounded-full aspect-square w-20 p-4 text-center bg-[#F8EAE7]">
                    <i class="pi !text-4xl " :class="icon"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
