<template>
    <Link :href="href" v-bind="$attrs"
          class="flex flex-grow-0 flex-shrink-0 items-center py-3 px-4 font-medium text-gray-700 dark:text-primary-100  cursor-pointer box-border basis-full hover:bg-gray-100 dark:hover:bg-dark-100 hover:text-teal-700">
        {{ text }}
    </Link>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";

const props=defineProps([
    'text',
    'href',
])


</script>
