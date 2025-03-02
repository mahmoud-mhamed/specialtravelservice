<template>
    <div class="flex gap-2">
        <label v-if="label">{{ label }} : </label>
        <Image width="200" :src="src" preview/>
    </div>
</template>

<script setup>
import Image from 'primevue/image';
const props = defineProps({
    label: {type: String, default: null},
    src: {type: String, default: null},
})
</script>


<style scoped>

</style>
