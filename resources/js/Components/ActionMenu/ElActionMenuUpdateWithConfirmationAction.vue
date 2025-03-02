<template>
    <ElActionMenuItem icon="pi pi-pencil" @click="ref_dialog_update_action.confirmUpdate(href,dialogMessage)"
                      v-bind="$attrs" :ability="ability"
                      :text="text??$t('message.edit')"/>
    <ElDialogUpdateAction ref="ref_dialog_update_action"/>
</template>

<script setup>
import {ref} from "vue";
import ElActionMenuItem from "@/Components/ActionMenu/ElActionMenuItem.vue";
import ElDialogUpdateAction from "@/Components/Dialog/ElDialogUpdateAction.vue";

const ref_dialog_update_action=ref();
const props = defineProps({
    href: {type: String, default: null},
    text: {type: String, default: null},
    ability: {type: String, default: null},
    dialogMessage: {type: String, default: null},
})

</script>

<style scoped>

</style>
