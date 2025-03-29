<template>

    <label class="whitespace-nowrap">

        <span v-if="value && value!==0">

            {{ numberFormat(value) }}

            <sub  class="text-sm font-normal">$</sub>


        </span>

        <ElText v-else/>

    </label>

</template>

<script setup>

const props = defineProps({
    value: [String, Number],
});

function numberFormat(number) {
    return new Intl.NumberFormat('en-SA').format(number);
}

</script>
