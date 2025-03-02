<template>
    <ElActionMenuItem :href="href" :ability="ability" icon="pi pi-info-circle" :text="text ?? $t('message.info')"/>
</template>

<script setup>
import ElActionMenuItem from "@/Components/ActionMenu/ElActionMenuItem.vue";

const props = defineProps({
    ability: null,
    href: null,
    text: null
})
</script>
<style scoped>

</style>
