import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
import createPersistedState from 'vuex-persistedstate'

export default new Vuex.Store({
    state: {
        auth: {
            id: '',
            name: '',
            email: ''
        },
        is_auth: false,
    },
    mutations: {
        setAuthStatus (state) {
            state.is_auth = true;
        },
        setAuthUserDetail (state, auth) {
            for (let key of Object.keys(auth)) {
                state.auth[key] = auth[key] !== null ? auth[key] : '';
            }
            state.is_auth = true;
        },
        resetAuthUserDetail (state) {
            for (let key of Object.keys(state.auth)) {
                state.auth[key] = '';
            }
            state.is_auth = false;
            localStorage.removeItem('auth_token');
            axios.defaults.headers.common['Authorization'] = null;
        },
    },
    actions: {
        setAuthStatus ({ commit }) {
            commit('setAuthStatus');
        },
        setAuthUserDetail ({ commit }, auth) {
            commit('setAuthUserDetail',auth);
        },
        resetAuthUserDetail ({commit}){
            commit('resetAuthUserDetail');
        },
        
    },
    getters: {
        getAuthStatus: (state) => {
            return state.is_auth;
        },
        getAuthUser: (state) => {
            return state.auth;
        },
    },
    plugins: [
        createPersistedState({ storage: window.sessionStorage })
    ]
});