import Vue from "vue";
import App from "./App.vue";
import VueRouter from "vue-router";
import ElementUI from "element-ui";
import routes from "./routes";
import axios from "axios";

Vue.prototype.$http = axios;

import "element-ui/lib/theme-default/index.css";

Vue.use(VueRouter);
Vue.use(ElementUI);

const router = new VueRouter({
    model: 'history',
    base: __dirname,
    routes
});

new Vue(Vue.util.extend({router}, App)).$mount('#app');
