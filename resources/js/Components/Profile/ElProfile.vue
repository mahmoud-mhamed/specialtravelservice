<template>
    <main class="mb-3">
        <section v-if="$slots.header" class="mb-3">
            <slot name="header"/>
        </section>
        <section v-if="$slots.tabContent" :class="{'el-container':!$page.props.isTransparent}">
            <slot name="tabContent"></slot>
        </section>
    </main>
</template>

<script setup>

</script>

<style scoped>

</style>
