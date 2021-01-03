require('./bootstrap');

window.Vue = require('vue');
import store from './store'
import router from './router';

const app = new Vue({
    el: '#app',
    router,
    store
});
