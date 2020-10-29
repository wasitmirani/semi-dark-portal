/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import router from "./router";
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'




Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component("pagination", require("laravel-vue-pagination"));

Vue.prototype.$base_url = window.location.origin;
Vue.prototype.$hostapi_url = window.location.origin + "/api";
const app = new Vue({
    el: '#app',
    router,
});
