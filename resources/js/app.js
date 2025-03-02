import './bootstrap';
import '../css/app.css';
import '../css/components.css';
import '../css/theam.css';
import '../css/prime.css';

import {createApp, h} from 'vue'
import {createInertiaApp, Link} from '@inertiajs/vue3'
import PrimeVue from 'primevue/config';
import 'primeicons/primeicons.css';
import {ability_else, ability_if} from "@/directive/AbilityDirective.js";
import Tooltip from 'primevue/tooltip';

import ElPanel from "@/Components/Main/ElPanel.vue";
import ElText from "@/Components/Text/ElText.vue";

import ToastService from 'primevue/toastservice';
import {createI18n} from "vue-i18n";
import CKEditor from '@mayasabha/ckeditor4-vue3';

const imports = {
    en: import.meta.glob(`./Lang/en/*.js`, {
        eager: true,
        import: "default",
    }),
    ar: import.meta.glob(`./Lang/ar/*.js`, {
        eager: true,
        import: "default",
    }),
};
const locales = Object.keys(imports);
import LoginLayout from "@/Layout/LoginLayout.vue";
import MasterLayout from "@/Layout/MasterLayout.vue";

import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/index.esm.js';
import {MyThemePreset} from "@/theme.js";

const getLocaleMessages = () =>
    locales.reduce(
        // The first parameter 'messages' is the main object where we combine messages for each language
        (messages, locale) => ({
            // Copy the messages from the previous language using the spread operator
            ...messages,
            // Combine messages for the current language
            [locale]: Object.values(imports[locale]).reduce(
                // The first parameter 'message' is a temporary object to combine messages for the current language
                (message, current) => ({...message, ...current}),
                {}
            ),
        }),
        // Starting with an empty object
        {}
    );
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
createInertiaApp({
    title: (title) => title ? `${title} - ${appName}` : appName,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true});
        let page = pages[`./Pages/${name}.vue`];
        if (!page.default?.layout) {
            if (name.startsWith('Soon') || name.startsWith('Users/Login')) {
                page.default.layout = LoginLayout;
                return page;
            }
            page.default.layout = MasterLayout;
        }
        return page;
    },
    setup({el, App, props, plugin}) {
        const i18n = createI18n({
            locale: props.initialPage.props.lang.current,
            messages: getLocaleMessages() || [],
            legacy: false,
        });
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(i18n)
            .use(ZiggyVue)
            .use(PrimeVue, {
                theme: {
                    preset: MyThemePreset,
                    options: {
                        darkModeSelector: '.dark-mode',
                    }
                },
            })
            .use(ToastService)
            .use(CKEditor)
            .component('Link', Link)
            .component('ElPanel', ElPanel)
            .component('ElText', ElText)
            .directive('ability', ability_if)
            .directive('else-ability', ability_else)
            .directive('tooltip', Tooltip)
            .mount(el)
    },
}).then(r => {})
