<template>
    <div>
        <label v-if="label">{{ label }} : </label>
        <ElText :value="value"/>
    </div>
</template>

<script setup>
const props = defineProps({
    label: {type: String, default: null},
    value: {type: String, default: null},
})
</script>


<style scoped>

</style>
