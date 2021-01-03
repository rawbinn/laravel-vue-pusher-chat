require('./bootstrap');

window.Vue = require('vue');
import store from './store'
import router from './router';
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

const app = new Vue({
    el: '#app',
    router,
    store
});
