require('./bootstrap');
// require('./bootstrap.bundle.min.js');
// require('./isotope.pkgd.min.js');
require('./quill.min.js');
require('./quill-textarea.js');
require('./cf-common-scripts.js');
require('./common-scripts.js');
// require('alpinejs');


import Vue from 'vue';

window.Vue = require('vue');

import App from './components/App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import { routes } from './routes';

import { BootstrapVue } from 'bootstrap-vue';
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

import store from './store.js';

const router = new VueRouter({
    mode: 'history',
    base: 'grt',
    routes: routes,
    scrollBehavior(to, from, savedPosition) {
        // return { x: 0, y: 0, behavior: 'smooth' };
        return { x: 0, y: 0 };
    }
});

const app = new Vue({
    el: '#app',
    router: router,
    store,
    render: h => h(App),
});