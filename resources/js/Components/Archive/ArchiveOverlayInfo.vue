<template>
    <Popover ref="overlay_archive_info_ref" :showCloseIcon="true" :dismissable="true">
        <table class="table-auto border-collapse">
            <thead>
            <tr>
                <th class="border px-2 border-slate-300">{{ $t('message.property') }}</th>
                <th class="border px-2 border-slate-300">{{ $t('message.value') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="row?.collection_name">
                <td class="border px-2 border-slate-300">{{ $t('column.type') }}</td>
                <td class="border px-2 border-slate-300">
                    <ElText :value="row?.collection_name_text"/>
                </td>
            </tr>
            <tr v-if="row.name">
                <td class="border px-2 border-slate-300">{{ $t('column.name') }}</td>
                <td class="border px-2 border-slate-300" dir="ltr">
                    <ElText :value="row?.name"/>
                </td>
            </tr>
            <tr v-if="row?.mimetype">
                <td class="border px-2 border-slate-300">{{ $t('column.size_text') }}</td>
                <td class="border px-2 border-slate-300">
                    <ElText :value="row?.size_text"/>
                </td>
            </tr>

            <tr v-if="row?.bill">
                <td class="border px-2 border-slate-300">{{ $t('column.bill_id') }}</td>
                <td class="border px-2 border-slate-300">
                    <ElRouteBillProfile :model="row.bill"/>
                </td>
            </tr>

            <tr v-if="row?.created_by">
                <td class="border px-2 border-slate-300">{{ $t('column.created_by_id') }}</td>
                <td class="border px-2 border-slate-300">
                    <ElRouteUserProfile :show-email="false" :show-avatar="false" :model="row.created_by"/>
                </td>
            </tr>

            <tr>
                <td class="border px-2 border-slate-300">{{ $t('column.created_at') }}</td>
                <td class="border px-2 border-slate-300">{{ row?.created_at_text }}</td>
            </tr>
            </tbody>
        </table>
    </Popover>
</template>

<script setup>
import Popover from 'primevue/popover';
import {ref} from "vue";
import ElRouteBillProfile from "@/Components/ElRoutes/ElRouteBillProfile.vue";
import ElRouteUserProfile from "@/Components/ElRoutes/ElRouteUserProfile.vue";

const overlay_archive_info_ref = ref();
const row = ref([]);
const toggleOverlay = (event, overlay_row) => {
    row.value = overlay_row;
    overlay_archive_info_ref.value.toggle(event);
}
defineExpose({
    toggleOverlay
});
</script>

<style>
.p-popover.p-component {
    z-index: 10000 !important;
}
</style>
