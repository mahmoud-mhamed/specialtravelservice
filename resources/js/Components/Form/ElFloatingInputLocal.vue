<template>
    <floating-input v-for="item in ['ar','en']" :label="$t('column.'+name)+' '+$t('column.'+item)"
                    :required="item === 'en' ? required_en && required : required"
                    :processing="form.processing" :custom-error="form['errors'][name+'.'+item]" :type="type"
                    :form="form[name]" :name="item"/>
</template>

<script setup>
import FloatingInput from "@/Components/Form/ElFloatingInput.vue";

const props = defineProps({
    name: String,
    type: {
        type: String,
        default: 'text'
    },
    form: Object,
    required: {
        type: Boolean,
        default: false
    },
    required_en: {
        type: Boolean,
        default: false
    },
})
</script>

<style scoped>

</style>
