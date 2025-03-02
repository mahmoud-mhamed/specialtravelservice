<template>
    <img v-if="!mimetype" :src="asset(`images/archive/folder.png`)"/>
    <img v-else-if="(['jpg','JPG','png','jpeg','svg']).includes(mimetype)" :src="asset(`images/archive/image.png`)"/>
    <img v-else-if="(['zip','7z']).includes(mimetype)" :src="asset(`images/archive/zip.png`)"/>
    <img v-else-if="(['docx','doc']).includes(mimetype)" :src="asset(`images/archive/doc.png`)"/>
    <img v-else-if="(['xlsx','xls']).includes(mimetype)" :src="asset(`images/archive/excel.png`)"/>
    <img v-else-if="(['ppt','pptx']).includes(mimetype)" :src="asset(`images/archive/ppt.png`)"/>
    <img v-else-if="(['pdf','PDF']).includes(mimetype)" :src="asset(`images/archive/pdf.png`)"/>
    <img v-else-if="(['MP4']).includes(mimetype)" :src="asset(`images/archive/video.png`)"/>
</template>

<script setup>

import {asset} from "@/Helpers/Functions.js";

const props = defineProps({
    'mimetype': {type: String, default: null},
});


</script>
<style scoped>
img{
    width:64px;
    height:64px;
}
</style>
