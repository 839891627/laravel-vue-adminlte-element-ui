import Vue from "vue";
import App from "./App.vue";
import VueRouter from "vue-router";
import ElementUI from "element-ui";
import routes from "./routes";
import axios from "axios";
import "element-ui/lib/theme-default/index.css";

Vue.use(VueRouter);
Vue.use(ElementUI);

axios.defaults.baseURL = '/api/'
axios.defaults.headers.common = {
	'Cache-Control': 'no-cache',
	'X-CSRF-TOKEN': window.Laravel.csrfToken,
	'X-Requested-With': 'XMLHttpRequest',
	'Content-Type': 'application/vnd.api+json',
	'Accept': 'application/vnd.api+json'
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
	linkActiveClass: 'active',
	routes
});

router.beforeEach((to, from, next) => {
	if (to.matched.some(record => record.meta.requiresAuth) && !sessionStorage.getItem('token')) {
		next({
			path: '/login',
			query: {redirect: to.fullPath}
		})
	} else {
		next()
	}
})

new Vue({
	el: '#app',
	router,
	render: h => h(App)
});
