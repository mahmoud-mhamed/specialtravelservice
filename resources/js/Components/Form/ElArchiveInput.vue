<template>
    <aside class="h-full">
        <label class="text-start flex gap-1" :for="name" :class="{'p-error':hasError()}">
            {{ label ?? $t('column.' + name) }}
            <SpanRequired v-if="required"/>
        </label>
        <input :id="!form.processing?name:'disabled_'+name" type="file"
               class="hidden" multiple :disabled="form.processing"
               @input="form[name]=$event.target.files[0];" @change="change">
        <div>
            <label :for="name" class="flex">
                <img v-if="is_pdf" class="w-[66px]" :src="asset(`images/archive/pdf.png`)"/>
                <Avatar v-else
                    :image="new_file_preview && form[name] ?new_file_preview : (oldImagePreview??asset('images/main/no_image.png'))"
                    class="bg-origin-content bg-contain"
                    shape="squre"
                    size="xlarge"/>
                <SvgEdit class="text-gray-500" v-if="!form.processing"/>
            </label>
            <ElTextError v-if="hasError()" :value="form['errors'][name]"/>
        </div>
    </aside>
</template>

<script setup>
import Avatar from 'primevue/avatar';
import SvgEdit from "@/Components/Svg/SvgUpload.vue";
import {ref} from "vue";
import SpanRequired from "@/Components/Form/ElSpanRequired.vue";
import ElTextError from "@/Components/Text/ElTextError.vue";
import {asset} from "@/Helpers/Functions.js";

const props = defineProps({
    label: String,
    name: String,
    form: Object,
    required: {type: Boolean, default: false},
    oldImagePreview: {type: String, default: null},
});
const new_file_preview = ref(null);
const is_pdf = ref(props.oldImagePreview?.includes('pdf'));
const change = (e) => {
    let reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);
    let file_type= e.target.files[0].type;
    is_pdf.value=file_type.includes('application/pdf');
    reader.onload = (e) => {
        new_file_preview.value = e.target.result;
    }
}
const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;
</script>

<style scoped>

</style>
