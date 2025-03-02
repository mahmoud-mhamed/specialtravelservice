<template>
    <label>
        {{ value == null || value === '' || (value == '0' && zeroToNull) ? '---' : value }}
    </label>
</template>

<script setup>
const props = defineProps({
    value: {type: String, default: null},
    zeroToNull: {type: Boolean, default: true}
})
</script>

<style scoped>

</style>
