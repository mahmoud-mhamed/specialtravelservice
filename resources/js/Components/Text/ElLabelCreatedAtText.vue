<template>
    <div>
        <label>{{ $t('column.created_at') }} : </label>
        <ElText :value="model.created_at_text"/>
    </div>
</template>

<script setup>
const props = defineProps({
    model: {type: String, default: null},
})
</script>


<style scoped>

</style>
