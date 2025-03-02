<template>
    <component :is="href?'Link':'button'" type="button" :href="href" v-bind="$attrs"
               class="bg-white border-secondary-500 text-secondary-500 hover:bg-secondary-500 hover:text-white button-classes">
        <span v-if="text" v-text="text"/>
        <slot v-else/>
    </component>
</template>
<script setup>
const props = defineProps({
    text: {
        type: String,
        default: null,
    },
    href: {
        type: String,
        default: null,
    }
})
</script>

<style scoped>

</style>
