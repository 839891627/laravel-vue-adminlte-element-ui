import Home from "../components/Home.vue";
import Login from "../pages/Login.vue";
import User from "../pages/User/index.vue";
import UserAdd from "../pages/User/add.vue";
import UserEdit from "../pages/User/edit.vue";
import Permission from "../pages/System/Permission/index.vue";
import Role from "../pages/System/Role/index.vue";
import RoleAdd from "../pages/System/Role/add.vue";
import RoleEdit from "../pages/System/Role/edit.vue";

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
		redirect: '/user',
		// component: Dashboard
	}, {
		path: '/user',
		name: 'user.index',
		component: User,
	}, {
		path: '/user/add',
		name: 'user.add',
		component: UserAdd,
	}, {
		path: '/user/:id/edit',
		name: 'user.edit',
		component: UserEdit,
	}, {
		path: 'system/permissoins',
		name: 'system.permission',
		component: Permission
	}, {
		path: 'system/roles',
		name: 'system.role',
		component: Role
	}, {
		path: 'system/roles/create',
		name: 'system.role.add',
		component: RoleAdd
	}, {
		path: 'system/roles/:id/edit',
		name: 'system.role.edit',
		component: RoleEdit
	}, {
		path: '*',
		redirect: {
			name: 'home'
		}
	}]
}]
