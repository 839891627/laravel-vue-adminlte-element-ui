import Home from "../components/Home.vue";
import Dashboard from "../pages/Dashboard.vue";
import Login from "../pages/Login.vue";
import User from "../pages/User.vue";

export default [{
    path: '/login',
    component: Login
}, {
    path: '/',
    component: Home,
    meta: {
        requiresAuth: true
    },
    children: [{
        path: '',
        name: 'home',
        component: Dashboard
    },{
        path: 'users',
        name: 'user',
        component: User
    },{
        path: '*',
        redirect: {
            name: 'home'
        }
    }]
}]
