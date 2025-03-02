<template>
    <div class="flex gap-2 flex-wrap" v-if="data.archives || data.archives.length">
        <ArchiveCard :archive="item" v-for="item in data.archives"/>
    </div>
</template>

<script setup>
import ArchiveCard from "@/Components/Archive/ArchiveCard.vue";

const props = defineProps(['data']);
</script>
