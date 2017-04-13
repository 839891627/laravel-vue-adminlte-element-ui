import Home from "../components/Home.vue";
import Dashboard from "../pages/Dashboard.vue";

export default [{
    path: '/',
    component: Home,
    children: [{
        path: '',
        component: Dashboard
    }]
}]
