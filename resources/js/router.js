import Vue from 'vue'
import App from './App.vue'
import store from './store';
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
        meta:{guest: true}
    },
    {
        name: 'register',
        path: '/register',
        component: Register,
        meta:{guest: true}
    },
    {
        name: 'Home',
        path: '/',
        component: App,
        meta: { requiresAuth: true },
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

router.beforeEach(async (to, from, next) => {
    
    const isAuth = store.getters.getAuthStatus
    
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (!isAuth) {
            next('/login')
        } else {
            next()
        }
    }
    else if(to.matched.some(record => record.meta.guest)) {
        console.log('guest');
        if(isAuth) {
            return next('/')
        }
        else{
            next()
        }
    }
    else {
        next()
    }
 
 })

export default router