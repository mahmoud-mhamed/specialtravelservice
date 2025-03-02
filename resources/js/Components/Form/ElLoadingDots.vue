<template>
    <div>
        <span class="inline-flex items-center gap-px">
            <span class="animate-blink mx-px h-2 w-2 rounded-full" :class='elClass'></span>
            <span class="animate-blink animation-delay-150 mx-px h-2 w-2 rounded-full" :class='elClass'></span>
            <span class="animate-blink animation-delay-300 mx-px h-2 w-2 rounded-full" :class='elClass'></span>
        </span>
    </div>
</template>
<script setup>
const props=defineProps({
  'elClass':{type:String,default:'bg-white'},
});
</script>

<style scoped>
@keyframes blink {
    0%, 100% { opacity: 0; }
    50% { opacity: 1; }
}

.animate-blink {
    animation: blink 1s infinite;
}

.animation-delay-150 {
    animation-delay: 0.15s;
}

.animation-delay-300 {
    animation-delay: 0.3s;
}
</style>
