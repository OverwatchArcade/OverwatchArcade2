import Vue from "vue";
import VueRouter from "vue-router";
import Overwatch from "./components/overwatch";
import Index from "./components/index";
import Contributors from "./components/contributors";
import Notfound from "./components/notfound";
import Notifications from "./components/notifications";
import Api_Index from "./components/api/index";
import Api_Overwatch from "./components/api/overwatch/index"
import Api_Overwatch2 from "./components/api/overwatch2/index"
import Api_Contributors from "./components/api/contributors/index"
import About from "./components/about";
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
        {path: '/api', component: Api_Index, name: 'api'},
        {path: '/api/overwatch', component: Api_Overwatch, name: 'api_overwatch'},
        {path: '/api/overwatch2', component: Api_Overwatch2, name: 'api_overwatch2'},
        {path: '/api/contributors', component: Api_Contributors, name: 'api_contributors'},
        {path: '/about', component: About, name: 'about'},
        {path: '/profile/*', component: ProfileIndex, name: 'profile_index'},
        {path: '/settings', component: Settings, name: 'settings'},
        {path: '/staff/overwatch', component: OverwatchSubmit, name: 'overwatch_submit'},
        {path: '/staff/overwatch2', component: Overwatch2Submit, name: 'overwatch2_submit'},
        {path: '*', component: Notfound, name: '404'}
    ],
    mode: 'history'
})
