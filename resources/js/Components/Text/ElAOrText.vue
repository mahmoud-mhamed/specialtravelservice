<template>
    <component :is="href?'a':'label'" class="text-base"
               :class="{'text-primary-700 cursor-pointer hover:text-primary-500':href}"
               v-bind="$attrs" :href="href" style="white-space: nowrap;">
        <ElText :value="label"/>
    </component>
</template>

<script setup>
const props = defineProps({
    href: {type: String, default: null},
    label: {type: String, default: null},
})
</script>

<style scoped>

</style>
