<template>
    <DataTable
        v-if="src?.data?.length ?? src?.length"
        :value="src?.data ?? src"
        responsiveLayout="scroll"
        :paginator="isPaginated"
        paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
        :currentPageReportTemplate="`${$t('message.view')} {first} ${$t('message.to')} {last} ${$t('message.from')} {totalRecords}`"
        :lazy="true"
        @page="handlePageOrSort"
        @sort="handlePageOrSort"
        :loading="loading"
        removableSort
        :rows="rowsPerPage"
        :rowsPerPageOptions="[5,10,50,100,1000]"
        :totalRecords="totalRecords"
        :autoLayout="true"
        scrollable
        showGridlines
        stripedRows
        resizableColumns
        columnResizeMode="expand"
    >
        <template #empty>
            <div class="text-center">
                <ElTextNoData/>
            </div>
        </template>
        <template #loading>
            <div class="text-center text-2xl">
                {{$t('message.loading_please_wait')}}
            </div>
        </template>
        <slot/>
    </DataTable>
    <EmptyData v-else/>
</template>

<script setup>
import DataTable from 'primevue/datatable';
import {computed, ref} from 'vue';
import { router } from '@inertiajs/vue3';
import ElTextNoData from '@/Components/Text/ElTextNoData.vue';
import EmptyData from "@/Components/EmptyData.vue";

const props = defineProps({
    src: Object,
});

const loading = ref(false);

const isPaginated = computed(() => props.src?.data?.length > 0);
const rowsPerPage = computed(() => props.src.per_page ?? props.src.meta?.per_page ?? props.src.length);
const totalRecords = computed(() => props.src?.total ?? props.src.meta?.total ?? props.src.length);

const handlePageOrSort = (event) => {
    loading.value = true;
    router.reload({
        data: {
            page: event.page + 1,
            rows: event.rows,
            sortField: event.sortField,
            sortOrder: event.sortOrder,
        },
        onFinish: () => {
            loading.value = false;
        },
    });
};
</script>

<style>
.dark tr:nth-child(even) td.p-frozen-column {
    background: #1C2732 !important;
}
</style>
