<template>
    <ElPanel>
        <RoleFormCreateUpdate :abilities="data.abilities"/>
    </ElPanel>
</template>

<script setup>
import RoleFormCreateUpdate from "@/Pages/Roles/RoleFormCreateUpdate.vue";

const props = defineProps({
    data: Object,
});

</script>

<style scoped>

</style>
