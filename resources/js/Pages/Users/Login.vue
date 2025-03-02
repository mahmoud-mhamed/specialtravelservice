<script setup>
import ElFloatingInput from "@/Components/Form/ElFloatingInput.vue";
import {useForm} from "@inertiajs/vue3";
import {asset} from "@/Helpers/Functions.js";
import ElSubmitButton from "@/Components/Buttons/ElSubmitButton.vue";
import ElFloatingPassword from "@/Components/Form/ElFloatingPassword.vue";
import ElChangeLanguage from "@/Components/Main/ElChangeLanguage.vue";
import ElFormCheckbox from "@/Components/Form/ElFormCheckbox.vue";

const el_form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    el_form.post(route('dashboard.login.save'));
};
</script>

<template>
    <main class="min-h-screen flex flex-col justify-center items-center bg-gray-100 dark:bg-gray-900">
        <div>
            <img class="w-[200px] h-[200px]" :src="asset('images/logo.png')" alt="logo"/>
        </div>
<!--        <h1 class="mt-3 text-2xl">{{$t('message.login_info')}}</h1>-->
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form @submit.prevent="submit">
                <div class="flex flex-col gap-5 mt-3">
                    <el-floating-input type="email" required :form="el_form" name="email"/>
                    <el-floating-password required :form="el_form" name="password"/>
                </div>
                <ElFormCheckbox class="mt-3" :form="el_form" name="remember" :value="true"/>
                <div class="flex items-center justify-between mt-4">
                    <ElChangeLanguage/>
                    <ElSubmitButton :text="$t('message.login')" :form="el_form"/>
                </div>
            </form>
        </div>
    </main>
</template>

<style scoped>

</style>
