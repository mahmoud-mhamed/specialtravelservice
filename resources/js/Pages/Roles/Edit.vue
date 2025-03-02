<template>
    <ElPanel>
        <RoleFormCreateUpdate :role="data.role" :current_abilities="data.current_abilities" :abilities="data.abilities"/>
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
