<template>
    <button
        class="bg-primary-500 border-primary-500 button-classes
         text-white hover:bg-opacity-80text-base font-bold"
            type="submit" :disabled="form?.processing || progressing" v-bind="$attrs">
        <el-loading-dots v-if="progressing || form?.processing"/>
        <span v-else v-text="text"/>
    </button>
</template>

<script setup>
import ElLoadingDots from "./ElLoadingDots.vue";

defineProps({
    progressing: {
        type: Boolean,
        default: false
    },
    form: {type: Object, default: {}},
    text: String
})
</script>

<style scoped>

</style>
