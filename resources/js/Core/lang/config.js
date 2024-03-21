import { createI18n } from "vue-i18n";

import en from './en';
import da from './da';

const lang = window.document.head.querySelector("[name~=lang][content]")?.content || 'da';

const i18n = createI18n({
    locale: lang,
    legacy: false,
    messages: {
        en: en,
        da: da
    }
});

export default i18n;
