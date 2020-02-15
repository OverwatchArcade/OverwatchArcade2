import Vue from "vue";
import VueRouter from "vue-router";
import Overwatch from "./components/overwatch";
import Index from "./components/index";
import Contributors from "./components/contributors";
import Notfound from "./components/notfound";
import Notifications from "./components/notifications";
import Api from "./components/api";
import Settings from "./components/settings";
import ProfileIndex from "./components/profile/index";
import OverwatchSubmit from "./components/staff/overwatch/submit";
import Overwatch2Submit from "./components/staff/overwatch2/submit";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {path: '/', component: Index, name: 'dashboard'},
        {path: '/overwatch', component: Overwatch, name: 'overwatch'},
        {path: '/overwatch2', component: Overwatch, name: 'overwatch2'},
        {path: '/contributors', component: Contributors, name: 'contributors'},
        {path: '/notifications', component: Notifications, name: 'notifications'},
        {path: '/api', component: Api, name: 'api'},
        {path: '/profile/*', component: ProfileIndex, name: 'profile_index'},
        {path: '/staff/settings', component: Settings, name: 'settings'},
        {path: '/staff/overwatch', component: OverwatchSubmit, name: 'overwatch_submit'},
        {path: '/staff/overwatch2', component: Overwatch2Submit, name: 'overwatch2_submit'},
        {path: '*', component: Notfound, name: '404'}
    ],
    mode: 'history'
})
