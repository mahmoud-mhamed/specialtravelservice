<template>
    <label v-if="$slots.default">
        <slot/>
    </label>
    <label v-else>{{ value == null || (value == '' && value != '0') ||(value == '' && zeroToNull) ? '----' : value + ' %' }}</label>
</template>

<script setup>
const props = defineProps({
    value: {type: String, default: null},
    zeroToNull: {type: Boolean, default: true}
})
</script>


<style scoped>

</style>
