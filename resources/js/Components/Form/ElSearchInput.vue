<script setup>
import {ref, watch} from "vue";
import InputText from 'primevue/inputtext';
import {refDebounced} from "@vueuse/core";
import {router} from "@inertiajs/vue3";
import {useQuery} from "@/Helpers/useQuery.js";

const search=ref(useQuery().get('search'));
const processing=ref(false);
const searchD = refDebounced(search, 500);

watch(searchD, (search) => {
    processing.value=true;
    router.reload({
        data: {search},
        onFinish: () => {
            processing.value=false;
        },
    })
})

</script>

<template>
    <label class="w-[300px] inline-block -mt-3 relative p-input-icon-left text-dark-500">
        <span class="absolute top-[12.5px] start-[14px] dark:text-gray-400" style="z-index: 3333">
            <i v-if="!processing" class="pi pi-search"/>
            <i v-else class="pi pi-spin pi-spinner"/>
        </span>
        <InputText v-model="search" class="w-full !ps-8" size="small" :placeholder="$t('message.search_here')"/>
    </label>
</template>
