import Vue from "vue";
import router from "./router"
import Toasted from 'vue-toasted';
import alert from "./components/elements/alert";
import vueMoment from 'vue-moment'
import VueSweetalert2 from 'vue-sweetalert2';
import VueI18n from 'vue-i18n';
import Layout from "./components/etc/layout";

import { languages } from './i18n/index.js'
import { defaultLocale } from './i18n/index.js'
const messages = Object.assign(languages);

require('./bootstrap');

Vue.use(Toasted, {
    iconPack : 'fontawesome'
});
Vue.use(vueMoment);
Vue.use(VueSweetalert2);
Vue.use(VueI18n);

var i18n = new VueI18n({
    locale: defaultLocale,
    fallbackLocale: 'US',
    messages
});

const app = new Vue({
    el: '#app',
    i18n,
    router,
    components: {
        alert,
        Layout
    }
});

