<script setup>
import {asset} from "@/Helpers/Functions.js";
import ElSecondaryButton from "@/Components/Buttons/ElSecondaryButton.vue";
import ElPrimaryButton from "@/Components/Buttons/ElPrimaryButton.vue";
import ElFormCheckbox from "@/Components/Form/ElFormCheckbox.vue";
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import Dialog from "primevue/dialog";
import ElChartComponent from "@/Components/Charts/ElChartComponent.vue";

const props = defineProps({
    data: Object
});
const pay_form = useForm({
    terms_and_conditions: false,
});
const select_show_terms_and_conditions = ref(false);
const dialog_terms_and_conditions = ref(false);
</script>

<template>
    <main class="min-h-screen flex flex-col justify-center items-center bg-gray-100 dark:bg-gray-900">
        <div>
            <img class="w-[300px] h-[300px]" :src="asset('images/logo.png')" alt="logo"/>
        </div>
        <div class="text-3xl flex flex-col gap-2 mt-3">
            <div>
                {{ $t('message.welcome_for_pay') }} : {{ data.bill.client_name }}
            </div>
            <div>
                {{ $t('column.service') }} :
                {{ data.bill.service }}
            </div>
            <div>
                {{ $t('column.price') }} :
                {{ data.bill.price }} $
            </div>

        </div>
        <div class="flex justify-between mt-3">
            <div class="font-bold">
                <div class="flex items-center content-center justify-center gap-2">
                    <ElFormCheckbox :binary="true" :hide-label="true" :form="pay_form" name="terms_and_conditions"/>
                    <div class="pt-2 hover:underline hover:font-bold cursor-pointer"
                         @click="dialog_terms_and_conditions=true">{{ $t('column.terms_and_conditions') }}
                    </div>
                </div>
                <div v-if="select_show_terms_and_conditions && !pay_form.terms_and_conditions" class="!text-red-500">
                    {{ $t('message.please_accept_terms_and_conditions') }}
                </div>
            </div>
            <div class="ms-7">
                <a :href="data.bill?.payment_link" v-if="pay_form.terms_and_conditions" target="_blank">
                    <ElPrimaryButton :text="$t('message.pay_now')"/>
                </a>
                <ElPrimaryButton v-else @click="select_show_terms_and_conditions=true" :text="$t('message.pay_now')"/>
            </div>
        </div>
    </main>
    <Dialog v-model:visible="dialog_terms_and_conditions" :rtl="true" maximizable2 :style="{width: '950px'}"
            :header="$t('column.terms_and_conditions')" :modal="true">
        <div class="-mt-1">
            <div class="px-4">
                All payments are processed through secure gateways (SSL/TLS) with data encryption.
                <br>
                The company does not store credit card information after the transaction is completed.
                <br>

                The customer is responsible for ensuring their device is secure (antivirus) before payment.

                . Cancellation and Refund Policy
                <br>
            </div>

            <p class="mt-3">
                <b>Cancellation by Customer:</b>
            </p>
            <div class="px-4">
                Reservations may be cancelled according to the policy of each service.

                Last-minute cancellations (less than 24-48 hours) are non-refundable.

            </div>

            <p class="mt-3">
                <b>Cancellation by Company:</b>
            </p>
            <div class="px-4">

                If the trip/service is cancelled by the company, the full amount will be refunded or an alternative will
                be offered.
            </div>
            <p class="mt-3">
                <b> Privacy Policy:</b>
            </p>
            <div class="px-4">

                The customer's personal data will be used only to complete the reservation and will not be shared with
                third parties without permission (unless required by official authorities, such as visas).
            </div>
        </div>
    </Dialog>
</template>

<style scoped>

</style>
