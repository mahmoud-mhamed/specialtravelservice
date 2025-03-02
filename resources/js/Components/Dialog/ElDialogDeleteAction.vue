<template>
    <Dialog v-model:visible="displayConfirmation" :rtl="true" :style="{width: '450px'}"
            :header="$t('message.confirm_delete')"
            :modal="true">
        <div class="confirmation-content flex">
            <i class="pi pi-exclamation-triangle text-red-900 mr-3" style="font-size: 2rem"/>
            <label>
                {{ $t('message.are_you_sure_delete') }}
                <b class="underline mx-2" dir="ltr">{{ dialogMessage ?? '' }}</b>
                ؟
            </label>
        </div>
        <template #footer>
            <div class="flex gap-3">
                <Button :label="$t('message.cancel')" icon="pi pi-times" class="py-2 p-button-secondary"
                        :disabled="form.processing" @click="displayConfirmation=false"/>
                <Button :label="$t('message.delete')" icon="pi pi-check" class="py-2 p-button-danger p-button-danger2"
                        :disabled="form.processing" @click="submitConfirmation"/>
            </div>
        </template>

    </Dialog>
</template>

<script setup>
import {ref} from "vue";
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import {useForm} from "@inertiajs/vue3";

const form = useForm({});
const href=ref();
const dialogMessage=ref();
const displayConfirmation = ref(false);
const emit = defineEmits(['success'])
const confirmDelete = (el_href,el_dialog_message) => {
    href.value = el_href;
    dialogMessage.value = el_dialog_message;
    displayConfirmation.value=true;
}
defineExpose({
    confirmDelete,
})

const submitConfirmation = () => {
    form.delete(href.value, {
        preserveState: false,
        onSuccess: () => {
            displayConfirmation.value=false;
            emit('success');
        },
    });
}
</script>

<style scoped>

</style>
