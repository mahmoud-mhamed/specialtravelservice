<template>
    <div>
        <p v-if="title" class="text-sm -mb-2">
            {{title}} :
            <label class="">{{value.toFixed(2) * 1}}%</label>
        </p>
        <ProgressBar :style="`height: ${props.height}em;`" :value="value.toFixed(2)" class="inline-block w-full bg-secondary-100"/>
    </div>
</template>

<script setup>
import ProgressBar from "primevue/progressbar";

const props = defineProps({
    value: {type: Number, default: null},
    title: {type: String, default: null},
    height: {type: Number, default: .5},
})
</script>


<style scoped>

</style>
