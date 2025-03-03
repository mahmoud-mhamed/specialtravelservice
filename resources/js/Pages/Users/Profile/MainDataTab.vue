<template>
    <ElContainer>
        <section class="grid grid-cols-2 mt-3 gap-4 text-lg">
            <div>
                <label>{{ $t('column.name') }} : </label>
                <label class="underline">{{ data.row.name }}</label>
            </div>
            <div>
                <label>{{ $t('column.email') }} : </label>
                <label class="underline ">{{ data.row.email }}</label>
            </div>
            <div>
                <label>{{ $t('column.created_at_text') }} : </label>
                <label>{{ data.row.created_at_text }}</label>
            </div>
        </section>
    </ElContainer>
</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";

const props = defineProps(['data']);
</script>
