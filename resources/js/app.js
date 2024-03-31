import './bootstrap';
import '../css/app.css';
import '@trevoreyre/autocomplete-vue/dist/style.css'
import '@vueform/multiselect/themes/default.css';
import '../css/fontawesome/css/all.css';
import '../css/resource.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import {createPinia} from "pinia";
import i18n from './Core/lang/config';
import 'viewerjs/dist/viewer.css';
import VueViewer from 'v-viewer';

import PrimeVue from 'primevue/config';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'MitFossil';
window.csrf_token = window.document.head.querySelector("[name~=csrf-token][content]")?.content || '';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {

        const pinia = createPinia();

        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(i18n)
            .use(pinia)
            .use(VueViewer)
            .use(ZiggyVue, Ziggy)
            .use(PrimeVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
