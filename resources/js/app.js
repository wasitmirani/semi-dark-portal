/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import router from "./router";
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
import VueProgressBar from "vue-progressbar";
import moment from 'moment';


Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component("pagination", require("laravel-vue-pagination"));
Vue.use(VueProgressBar, {
    color: "rgb(6, 214, 93)",
    failedColor: "red",
    height: "4px"
});
Vue.filter("timeformat", function(value) {
    if (value) {
        return moment
            .utc(String(value))
            .local()
            .fromNow();
    }
});

Vue.prototype.$base_url = window.location.origin;
Vue.prototype.$hostapi_url = window.location.origin + "/api";
Vue.prototype.$config={headers: { Authorization: `Bearer `+authUser.api_token }};

const app = new Vue({
    el: '#app',
    router,
});
