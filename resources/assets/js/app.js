import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App.vue';
import Dashboard from './components/Dashboard.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Roles from './components/roles/Roles.vue';
import CreateRole from './components/roles/CreateRole.vue';
import EditRole from './components/roles/EditRole.vue';
import Users from './components/users/Users.vue';
import CreateUser from './components/users/CreateUser.vue';
import EditUser from './components/users/EditUser.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

axios.defaults.baseURL = 'http://localhost:8000/api';

const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                auth: false
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                auth: true
            }
        },
        {
            path: '/roles',
            name: 'roles',
            component: Roles,
            meta: {
                auth: true
            }
        },
        {
            name: 'createrole',
            path: '/roles/create',
            component: CreateRole
        },
        {
            name: 'editrole',
            path: '/roles/edit/:id',
            component: EditRole
        },
        {
            name: 'users',
            path: '/users',
            component: Users
        },
        {
            name: 'createuser',
            path: '/users/create',
            component: CreateUser
        },
        {
            name: 'edituser',
            path: '/users/edit/:id',
            component: EditUser
        }
    ]
});

Vue.router = router

Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
})

App.router = Vue.router

new Vue(App).$mount('#app');
