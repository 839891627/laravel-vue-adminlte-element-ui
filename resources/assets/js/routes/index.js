import Home from "../components/Home.vue";
import Dashboard from "../pages/Dashboard.vue";
import Login from "../pages/Login.vue";
import User from "../pages/User/index.vue";
import UserAdd from "../pages/User/add.vue";

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
    }, {
        path: '/user',
        name: 'user.index',
        component: User,
    }, {
        path: '/user/add',
        name: 'user.add',
        component: UserAdd,
    }, {
        path: '*',
        redirect: {
            name: 'home'
        }
    }]
}]
