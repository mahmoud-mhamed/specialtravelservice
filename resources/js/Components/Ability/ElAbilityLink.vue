<template>
    <template v-if="href">
        <Link :href="href" v-ability="props.ability" class="link-text">
            <slot/>
        </Link>
        <label v-else-ability="ability">
            <slot/>
        </label>
    </template>
    <template v-else>
        <label class="not-link">
            <slot/>
        </label>
    </template>

</template>

<script setup>
const props = defineProps({
    href: {
        type: String,
        default: null,
    },
    ability: {
        type: String,
        default: null,
    },
})
</script>
<style scoped>

</style>
