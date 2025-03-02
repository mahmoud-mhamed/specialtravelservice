<template>

    <ElActionMenuItem
        icon="pi pi-trash"
        @click="ref_dialog_delete_action.confirmDelete(href,dialogMessage,elId)"
        v-bind="$attrs"
        :ability="ability"
        :text="text??$t('message.delete')"
    />

    <ElDialogDeleteAction ref="ref_dialog_delete_action"/>

</template>

<script setup>

import {ref} from "vue";
import ElActionMenuItem from "@/Components/ActionMenu/ElActionMenuItem.vue";
import ElDialogDeleteAction from "@/Components/Dialog/ElDialogDeleteAction.vue";

const ref_dialog_delete_action = ref();

const props = defineProps({
    href: {type: String, default: null},
    text: {type: String, default: null},
    ability: {type: String, default: null},
    dialogMessage: {type: [String, Object], default: null},
    elId: {type: String, default: null},
})

</script>
