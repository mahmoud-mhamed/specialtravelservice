<template>
    <ElActionMenuItem :href="href" :ability="ability" icon="pi pi-pencil" :text="showText ? (text ?? $t('message.edit')) : ''"/>
</template>

<script setup>
import ElActionMenuItem from "@/Components/ActionMenu/ElActionMenuItem.vue";

const props = defineProps({
    ability: null,
    href: null,
    text: null,
    showText: {type: Boolean, default: true}
})
</script>
<style scoped>

</style>
