import Vue from 'vue'
import App from './App.vue'
import Dashboard from './views/Dashboard.vue'
import Login from './views/auth/Login.vue'
import Register from './views/auth/Register.vue'
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    {
        name: 'login',
        path: '/login',
        component: Login,
    },
    {
        name: 'register',
        path: '/register',
        component: Register,
    },
    {
        name: 'Home',
        path: '/',
        component: App,
        children: [
            {
                name: 'dashboard',
                path: '/',
                component: Dashboard
            }
        ]
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

export default router