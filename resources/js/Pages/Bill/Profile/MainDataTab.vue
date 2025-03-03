<template>
    <ElContainer>
        <section class="grid md:grid-cols-2 gap-4 text-lg">


            <ElLabelValueText :value="data.row.created_at_text" :label="$t('column.created_at')"/>
            <ElModelUpdatedAtValueText :model="data.row" :label="$t('column.updated_at')"/>

            <ElLabelValueText :value="data.row.note" :label="$t('column.notes')"/>
        </section>
    </ElContainer>


</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";
import {usePage} from "@inertiajs/vue3";
import ElLabelValueText from "@/Components/Text/ElLabelValueText.vue";
import ElModelUpdatedAtValueText from "@/Components/Text/ElModelUpdatedAtValueText.vue";
import ElLabelImage from "@/Components/Text/ElLabelImage.vue";
import ElLabelValuePrice from "@/Components/Text/ElLabelValuePrice.vue";

const props = defineProps(['data']);
</script>
