import Vue from "vue";
import router from "./router"
import Toasted from 'vue-toasted';
import alert from "./components/elements/alert";
import vueMoment from 'vue-moment'
import VueSweetalert2 from 'vue-sweetalert2';
import VueI18n from "vue-i18n";

import translations from "./i18n";

require('./bootstrap');

Vue.use(Toasted, {
    iconPack : 'fontawesome'
});

Vue.use(vueMoment);
Vue.use(VueSweetalert2);
Vue.use(VueI18n);

const app = new Vue({
    el: '#app',
    router,
    components: {
        alert,
    }
});

