<template>
    <Dialog v-model:visible="show_dialog" :style="{width: '90rem'}" modal maximizable>
        <template #header>
            <section class="flex w-full justify-between">
                <div class="flex gap-4">
                    {{ $t('message.view') }}
                    -
                    <label>
                        {{archive.collection_name_text}}
                    </label>
                    <span dir='ltr'> {{ archive?.name }}</span>
                </div>
                <ElPrimaryButton
                    :is-a="true" :href="archive.file_url"
                    :download="archive.collection_name_text??archive.name"
                    @click="alertMessageHideElement($event,$t('message.please_wait_loading'))"
                    class="px-0! text-center mx-3 w-[150px]!">
                    {{ $t('message.download') }}
                </ElPrimaryButton>
            </section>
        </template>
        <section>
            <object v-if="archive.mimetype==='pdf'" :data="archive.file_url" type="application/pdf"
                    class="w-full object min-h-[70vh]"/>
            <img v-if="(['png','jpg','jpeg','gif','svg']).includes(archive.mimetype)"
                 :src="archive.file_url"/>
        </section>
    </Dialog>
</template>

<script setup>
import Dialog from "primevue/dialog";
import {ref} from "vue";
import ElPrimaryButton from "@/Components/Buttons/ElPrimaryButton.vue";
import {alertMessageHideElement} from "@/Helpers/Functions.js";

const archive = ref();

const show_dialog = ref(false);

const viewArchive = (archiveToShow = null) => {
    archive.value = archiveToShow;
    show_dialog.value = true;
}

defineExpose({
    viewArchive
});
</script>
