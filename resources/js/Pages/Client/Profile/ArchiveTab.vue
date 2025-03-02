<template>
    <div class="flex gap-2 flex-col" v-if="data.archives || data.archives.length">
        <div v-for="bill_archives in data.archives">
            <ElCardWithTitle>
                <template #title>
                    <div v-if="bill_archives?.[0]?.['bill']" class="flex gap-2">
                        {{ $t('message.bill') }} :
                        <ElRouteBillProfile :model="bill_archives[0]['bill']"/>
                    </div>
                    <div v-else>
                        {{ $t('message.other_files') }}
                    </div>
                </template>
                <div class="flex flex-wrap gap-4">
                    <ArchiveCard :archive="item" v-for="item in bill_archives"/>
                </div>
            </ElCardWithTitle>
        </div>
    </div>
</template>

<script setup>
import ElContainer from "@/Components/Card/ElContainer.vue";
import ArchiveCard from "@/Components/Archive/ArchiveCard.vue";
import ElCardWithTitle from "@/Components/Card/ElCardWithTitle.vue";
import ElRouteBillProfile from "@/Components/ElRoutes/ElRouteBillProfile.vue";

const props = defineProps(['data']);
</script>
