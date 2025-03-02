<template>
    <div>
        <label>{{ $t('column.updated_at') }} : </label>
        <ElText :value="model.created_at !== model.updated_at?model.updated_at_text:null"/>
    </div>
</template>

<script setup>
import ElText from "@/Components/Text/ElText.vue";

const props = defineProps({
    model: {type: String, default: null},
})
</script>


<style scoped>

</style>
