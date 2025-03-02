<template>
    <div>
        <label v-if="label">{{ label }} : </label>
        <ElPrice :currency="currency" :value="value"/>
    </div>
</template>

<script setup>
import ElPrice from "@/Components/Text/ElPrice.vue";

const props = defineProps({
    label: {type: String, default: null},
    value: {type: String, default: null},
    currency: {type: Object, default: null},
})
</script>


<style scoped>

</style>
