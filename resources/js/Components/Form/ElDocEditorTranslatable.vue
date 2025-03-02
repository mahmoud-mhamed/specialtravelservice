<template>
    <section>
        <template v-for="item in ['ar','en']">
            <ElDocEditor :form="form[name]" :name="item"
                         :is-letter="isLetter" :required="required"
                         :label="$t('column.'+name)+' '+$t('column.'+item)"
                         :height="height" :language="item"/>
        </template>
    </section>
</template>

<script setup>
import ElDocEditor from "@/Components/Form/ElDocEditor.vue";

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
