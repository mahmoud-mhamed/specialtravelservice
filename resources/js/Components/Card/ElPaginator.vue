<script setup>
import Paginator from "primevue/paginator";
import {router} from "@inertiajs/vue3";
import {ref} from "vue";

const props = defineProps({
    data: Object,
});
const onPage = (event) => {
    router.get(window.location.href, {
        'page': event.page + 1,
        'rows': event.rows,
    }, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    })
};
const offset = ref(props.data.current_page);
</script>

<template>
    <Paginator class="mb-9 bg-transparent" :rows="data.per_page"
               :alwaysShow="false"
               :first="props.data.current_page*data.per_page - data.per_page"
               @page="onPage($event)"
               template="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
               currentPageReportTemplate="عرض {first} إلي {last} من {totalRecords}"
               :totalRecords="data.total" :rowsPerPageOptions="[10, 20, 30]"></Paginator>
</template>

<style scoped>

</style>
