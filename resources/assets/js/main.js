import Vue from "vue";
import App from "./App.vue";
import VueRouter from "vue-router";
import ElementUI from "element-ui";
import routes from "./routes";
import axios from "axios";
import "element-ui/lib/theme-default/index.css";

Vue.use(VueRouter);
Vue.use(ElementUI);

axios.defaults.headers.common = {
    'Cache-Control': 'no-cache',
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
}

// Add a request interceptor
axios.interceptors.request.use(function (config) {
    // Do something before request is sent
    config.headers.Authorization = 'Bearer ' + sessionStorage.getItem('token')
    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});

// Add a response interceptor
axios.interceptors.response.use(function (response) {
    if (response.data.status_code === 401) {
        location.href = '/#/login'
    }
    return response;
}, function (error) {
    // Do something with response error
    return Promise.reject(error);
});

Vue.prototype.$http = axios;

const router = new VueRouter({
    model: 'history',
    base: __dirname,
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!sessionStorage.getItem('token') && to.path !== '/login') {
            next({
                path: '/login',
                query: {redirect: to.fullPath}
            })
        } else {
            next()
        }
    } else {
        next()
    }
})


new Vue(Vue.util.extend({router}, App)).$mount('#app');
