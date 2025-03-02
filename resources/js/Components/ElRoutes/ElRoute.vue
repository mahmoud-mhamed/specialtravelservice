<template>
    <AbilityLink :href="href" :ability="ability">
        <div class="flex gap-2 space-x-reverse">
            <slot v-if="$slots.avatar" name="avatar"/>
            <div class="text-direction">
                <div v-if="$slots.title" class="font-bold text-base">
                    <slot name="title"/>
                </div>
                <div v-if="$slots.description" class="text-slate-400 text-sm">
                    <slot name="description"/>
                </div>
            </div>
        </div>
    </AbilityLink>
</template>

<script setup>

import AbilityLink from "@/Components/AbilityLink.vue";

const props = defineProps({
    href: {
        type: String,
        default: null,
    },
    ability: {
        type: String,
        default: null,
    },
})
</script>

<style scoped>
.not-link button{
    color: black!important;
}
</style>
