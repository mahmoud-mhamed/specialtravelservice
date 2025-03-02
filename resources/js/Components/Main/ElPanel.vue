<template>
    <main class="p-4 dark:bg-dark-500">
        <header class="flex justify-between">
            <div>
                <div class="flex gap-2">
                    <ElBreadcrumb class="dark:text-white"/>
                </div>
            </div>
            <div>
                <div class="flex items-center gap-1">
                    <slot name="actions"/>
                </div>
            </div>
        </header>
        <div>
            <FilterForm v-if="usePage().props.filters" :filters="usePage().props.filters" class="mb-3"/>
            <slot/>
        </div>
    </main>
</template>

<script setup>
import ElBreadcrumb from "@/Components/Main/ElBreadcrumb.vue";
import FilterForm from "@/Components/Filter/FilterForm.vue";
import {usePage} from "@inertiajs/vue3";
</script>


<style scoped>

</style>
