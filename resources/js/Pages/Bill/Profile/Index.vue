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

const tapComponent = {
    'MainDataTab': MainDataTab,
};
const props = defineProps({
    data: {
        type: Object,
        default: []
    },
})

</script>

