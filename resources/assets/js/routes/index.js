import Home from "../components/Home.vue";
import Login from "../pages/Login.vue";
import Dashboard from "../pages/Dashboard.vue";

export default [{
    path: '/login',
    component: Login
}, {
    path: '/',
    component: Home,
    children: [{
        path: '',
        component: Dashboard
    }]
}]
