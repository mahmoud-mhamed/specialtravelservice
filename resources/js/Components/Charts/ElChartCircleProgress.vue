<script setup>
const props = defineProps({
    value: {
        type: Number,
        default: 0
    },
})
</script>
<template>
    <div class="w-[60px]">
        <div class="rounded-full aspect-square w-full text-center p-1"
             :style="{'background': 'conic-gradient(rgb(var(--color-primary-500)) '+props.value+'%, rgba(10,10,10, .1) 0)'}">
            <div
                class="bg-white w-full h-full rounded-full grid place-items-center border border-white shadow-md">
                <div class="p-2 pt-3 text-secondary-900">
                    <span v-text="'%' + props.value" class="font-bold leading-[0]"/>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
