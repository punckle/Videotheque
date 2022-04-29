import Vue from "vue";
import Vuex from "vuex";
import SearchResults from "./Vue/SearchResults";
import axios from 'axios';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

export default Vue;

Vue.use(Vuex)
Vue.prototype.$http = axios;

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

const store = new Vuex.Store({
    state: {},
    getters: {},
    mutations: {},
    actions: {}
})

new Vue({
    el: '#app-search_results',
    template: '<SearchResults/>',
    components: { SearchResults },
    store: store,
    data: {}
})
