<template>
    <ElPanel>
        <ElProfile>
            <template #header>
                <Header/>
            </template>

            <template #tabContent>
                <component :is="tapComponent[$page.props.tap_component]" :data="data"/>
            </template>
        </ElProfile>
    </ElPanel>

</template>
<script setup>
import ElProfile from "@/Components/Profile/ElProfile.vue";

import Header from "./Header.vue";
import MainDataTab from "./MainDataTab.vue";
import BillTab from "./BillTab.vue";
import ArchiveTab from "./ArchiveTab.vue";

const tapComponent = {
    'MainDataTab': MainDataTab,
    'BillTab': BillTab,
    'ArchiveTab': ArchiveTab,
};
const props = defineProps({
    data: {
        type: Object,
        default: []
    },
})

</script>

