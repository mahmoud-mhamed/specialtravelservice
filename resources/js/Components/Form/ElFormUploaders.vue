<template>
    <aside class="relative">
        <label>
            {{ label ?? $t('column.' + name) }}
            <ElTextRequired v-if="required"/>
        </label>

        <FileUpload :multiple="multiple" :accept="accept"
                    :maxFileSize="10000000" :required="required"
                    :show-cancel-button="form[name].length" :show-upload-button="false"
                    :chooseLabel="$t('message.select_files')" :cancelLabel="$t('message.remove_files')"
                    @select="handleSelectFile" @clear="handleRemoveFiles" @remove="handleRemoveFile">
            <template #empty>
                <p>{{ $t('message.drag_and_drop_files_to_upload') }}</p>
            </template>
        </FileUpload>

        <ElTextError v-if="hasError()" :value="customError??form['errors'][name]"/>
    </aside>
</template>

<script setup>
import FileUpload from 'primevue/fileupload';
import ElTextRequired from "@/Components/Text/ElTextRequired.vue";
import ElTextError from "@/Components/Text/ElTextError.vue";

const props = defineProps({
    form: Object,
    name: String,
    required: {
        type: Boolean,
        default: false
    },
    accept: {
        type: String,
    },
    customError:{
        type:Object,
        default:null,
    },
    multiple: {
        type: Boolean,
        default: true
    },
})

const handleSelectFile = (evt) => {
    props.form[props.name] = evt.files
}

const handleRemoveFile = (evt) => {
    props.form[props.name] = evt.files.filter(file => file.objectURL !== evt.file.objectURL)
}

const handleRemoveFiles = () => {
    props.form[props.name] = []
}
const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : !!props.customError;
</script>
