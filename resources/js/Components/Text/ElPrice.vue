<template>

    <label class="whitespace-nowrap">

        <span v-if="value && value!==0">

            {{ numberFormat(value) }}

            <sub v-if="currency && currency?.code" class="text-sm font-normal">{{ currency?.code }}</sub>


        </span>

        <ElText v-else/>

    </label>

</template>

<script setup>

const props = defineProps({
    value: [String, Number],
    currency: {type: Object, default: null}
});

function numberFormat(number) {
    return new Intl.NumberFormat('en-SA').format(number);
}

</script>
