<template>
    <component :is="href?(isA?'a':'Link'):'button'"  v-bind="$attrs" :href="href"
               class="bg-primary-500 border-secondary-500 hover:bg-primary-400 text-white button-classes">
        <span v-if="text" v-text="text"/>
        <slot v-else/>
    </component>
</template>

<script setup>
const props = defineProps({
    text: {
        type:String,
        default:null,
    },
    href: {
        type:String,
        default:null,
    },
    isA:{
        type:Boolean,
        default:false,
    }
})
</script>

<style scoped>

</style>
