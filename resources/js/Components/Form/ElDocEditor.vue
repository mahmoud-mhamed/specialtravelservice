<template>
    <label class="relative" :class="{'text-red-500':hasError()}">
        {{ label ?? $t('column.' + name) }}
        <ElTextRequired style="top: auto" v-if="required"/>
    </label>
    <ElTextError v-if="hasError()" :value="form['errors'][name]"/>
    <div class="mt-2" :class="{'letter':isLetter}">
        <ckeditor class="ckeditor-a4" :config="{
            height: props.height,
            language: props.language
        }" v-model="form[name]"></ckeditor>
    </div>
</template>

<script setup>
import {component as ckeditor} from '@mayasabha/ckeditor4-vue3'
import ElTextRequired from "@/Components/Text/ElTextRequired.vue";
import ElTextError from "@/Components/Text/ElTextError.vue";

const props = defineProps({
    form: Object,
    name: String,
    label: {
        type: String,
        default: null
    },
    required: Boolean,
    language: {
        type: String,
        default: 'ar'
    },
    height: {
        type: Number,
        default: 1123
    },
    isLetter: {
        type: Boolean,
        default: false
    },
});

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : null;
</script>


<style>
.letter .ckeditor-a4 .cke_inner {
    background: #DDD !important;
}

.letter .ckeditor-a4 iframe {
    width: 795px !important;
    margin: auto;
}

.letter .ckeditor-a4 .cke_bottom {
    margin-top: 30px;
}

.letter .ckeditor-a4 .cke_top {
    margin-bottom: 30px;
}
</style>
