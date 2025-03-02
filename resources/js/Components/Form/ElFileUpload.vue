<template>
    <section class="h-full">
        <label class="text-start flex gap-1" :for="name" :class="{'p-error':hasError()}">
            {{ label ?? $t('column.' + name) }}
            <SpanRequired v-if="required"/>
        </label>
        <div>
            <div class="flex items-center justify-center w-full">
                <label
                    class="flex flex-col mx-auto items-center justify-center w-full h-26 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                >
                    <div class="flex flex-col items-center justify-center">
                        <svg
                            aria-hidden="true"
                            class="w-10 h-10 mb-1 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                            ></path>
                        </svg>

                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                            class="font-semibold">{{ $t('message.click_to_upload') }}</span>
                        </p>
                    </div>
                    <input type="file" @change="inputChange" class="hidden"
                           :max="max" :required="required"
                           :multiple="multiple" :accept="accept"/>
                </label>
            </div>
            <aside v-if="old_files?.length || new_files.length">
                <table class="w-full">
                    <tbody>
                    <tr v-for="(image , index) in old_files" class="border rounded-md" :key="index">
                        <td>
                            <img :src="getPreviewFileImage(image)" :class="'avatar w-[60px] max-h-[60px] object-fit'"/>
                        </td>
                        <td>
                           <div class="pt-.5">
                               <a class="text-blue-600 cursor-pointer" :href="image" download="">
                                   {{ $t('message.download') }}
                               </a>
                               <a class="text-red-600 ms-3 cursor-pointer"
                                  @click="removeFile(false,index)">
                                   {{ $t('message.delete') }}
                               </a>
                           </div>
                        </td>
                    </tr>
                    <tr v-for="(file,key) in new_files" class="border rounded-md">

                        <td class="">
                            <img :src="file" :class="'avatar w-[60px] max-h-[60px] object-fit'"/>
                        </td>
                        <td>
                            <a class="text-center mx-3 col-span-2 text-danger-600 cursor-pointer"
                               @click="removeFile(true,key)">
                                {{ $t('message.delete') }}
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </aside>
            <ElTextError v-if="hasError()" :value="form['errors'][name]"/>
        </div>
    </section>
</template>

<script setup>
import {ref} from "vue";
import SpanRequired from "@/Components/Form/ElSpanRequired.vue";
import ElTextError from "@/Components/Text/ElTextError.vue";

const emit = defineEmits(["updateImage"]);

const props = defineProps({
    form: Object,
    old_urls: Array,
    max: {type: Number, default: 1},
    name: String,
    label: {type: String, default: null},
    required: {type: Boolean, default: false},
    multiple: {type: Boolean, default: false},
    accept: {type: String, default: 'image/*,application/pdf'},
})
const old_files = ref(Array.isArray(props.old_urls)?props.old_urls:[props.old_urls]);
if (!props.old_urls)
    old_files.value = props.form[props.name] ?? [];

const new_files = ref([]);
const new_files_form = ref([]);
const validImageTypes = [
    "image/gif", "image/jpeg", "image/png", "image/svg", "image/svg+xml", "image/jfif",
];

const getPreviewFileImage = (url) => {
    let validImageTypes = [".jpg", ".png", ".svg", ".jpeg", ".webp"];
    let lower_url = url.toLowerCase();
    for (let i = 0; i < validImageTypes.length; i++) {
        if (lower_url.endsWith(validImageTypes[i])) {
            return url;
        }
    }
    if (lower_url.endsWith(".pdf")) return "/default_image/pdf.png";
    return "/icons/file.png";
};

const inputChange = function (uploadFile) {
    let srcs = [];
    let uploadFiles = [];
    let files = uploadFile.target ? uploadFile.target.files : uploadFile;
    if (!props.multiple) {
        old_files.value = [];
    }
    for (let i = 0; i < files.length; i++) {
        uploadFiles[i] = files[i];
        const fileType = files[i]["type"];

        if (validImageTypes.includes(fileType)) {
            srcs[i] = URL.createObjectURL(files[i]);
        } else if (fileType === "application/pdf") {
            srcs[i] = "/icons/pdf.png";
        } else {
            srcs[i] = "/icons/file.png";
        }
    }
    new_files.value.push(...srcs);
    new_files_form.value.push(...uploadFiles);
    mergeOldAndNewFiles();
    emit("updateImage", srcs);
};

const mergeOldAndNewFiles = () => {
    let files = [];
    if (props.old_urls?.length) {
        files.push(...old_files.value);
    }
    if (new_files_form.value.length) {
        files.push(...new_files_form.value);
    }
    props.form[props.name] = props.multiple?files:files[0];
};
// Following function added so that user can remove uploaded file from component
const removeFile = function (is_new_file, key) {
    if (is_new_file) {
        new_files_form.value = new_files_form.value.filter(function (item, index) {
            return index !== key
        })
        new_files.value = new_files.value.filter(function (item, index) {
            return index !== key
        })
    } else {
        props.old_urls.splice(key, 1);
    }
    mergeOldAndNewFiles();
}

const hasError = () => props.form && (props.form['errors'] ?? false) ? props.form['errors'][props.name] : false;
</script>
