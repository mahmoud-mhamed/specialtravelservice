<template>

    <PageHead/>

    <div
        class="flex flex-col p-0 m-0 font-sans font-normal leading-5 box-border text-slate-900 print:overflow-scroll print:h-auto"
    >
        <div class="flex flex-row leading-5 box-border basis-auto text-slate-900">
            <MasterLayoutAsideBar/>
            <div class="flex flex-col w-full">
                <MenuBar/>
                <section class="flex flex-grow">
                    <ScrollPanel class="p-3" style="width:100%;">
                        <slot/>
                    </ScrollPanel>
                </section>
            </div>
        </div>
    </div>

    <NotificationAlert/>

</template>

<script setup>

import ScrollPanel from "primevue/scrollpanel";
import NotificationAlert from "@/Layout/Partial/NotificationAlert.vue";
import PageHead from "@/Layout/Partial/PageHead.vue";
import MenuBar from "@/Layout/MenuBar.vue";
import MasterLayoutAsideBar from "@/Layout/Partial/MasterLayoutAsideBar.vue";
</script>
