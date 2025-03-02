<template>
    <ElRoute v-if="model?.id" :ability="Ability.M_ROLES_EDIT" :href="route('dashboard.roles.edit',model?.id)">
        <template #title>{{ model.title }}</template>
    </ElRoute>
</template>

<script setup>

import ElRoute from "@/Components/ElRoutes/ElRoute.vue";
import {Ability} from "@/ability.js";

const props = defineProps({
    model: {type: Object, default: null},
})
</script>


<style scoped>

</style>
