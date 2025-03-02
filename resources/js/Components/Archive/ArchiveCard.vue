<template>
    <div class="border bg-white rounded-md p-2">
        <section class="flex justify-between gap-2 bg-white rounded-sm p-2">
            <div class="flex flex-col text-right gap-2 cursor-pointer" @click="ref_previewDialog.viewArchive(archive)">
                <label dir="ltr">
                    {{ archive.collection_name_text  }}
                </label>
                <label dir="ltr">
                    {{ archive.name }}
                </label>
            </div>

        </section>
        <div class="flex justify-between gap-2">
            <ArchiveIcon :mimetype="archive.mimetype" @click="ref_previewDialog.viewArchive(archive)"/>
            <ElActionMenu>
                <ElActionMenuInfo @click="ref_overlay_info.toggleOverlay($event,archive)"/>
            </ElActionMenu>
        </div>
    </div>
    <ElDialogArchivePreview ref="ref_previewDialog"/>
    <ArchiveOverlayInfo ref="ref_overlay_info"/>

</template>

<script setup>

import ElDialogArchivePreview from "@/Components/Archive/ElDialogArchivePreview.vue";
import ArchiveIcon from "@/Components/Archive/ArchiveIcon.vue";
import {ref} from "vue";
import ElActionMenu from "@/Components/ActionMenu/ElActionMenu.vue";
import ElActionMenuInfo from "@/Components/ActionMenu/ElActionMenuInfo.vue";
import ArchiveOverlayInfo from "@/Components/Archive/ArchiveOverlayInfo.vue";

const props = defineProps({
    'archive': Object,
});
const ref_previewDialog = ref();
const ref_overlay_info = ref();
</script>

