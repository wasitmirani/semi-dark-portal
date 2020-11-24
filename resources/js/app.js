/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import _ from  'lodash';
window.Vue = require('vue');
window._;
import router from "./router";
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
import VueProgressBar from "vue-progressbar";
import moment from 'moment';
import Swal from 'sweetalert2';

window.Swal = Swal;
window.moment=moment;
Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


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
Vue.filter('highlight', function(word, query){
  var check = new RegExp(query, "ig");
  return word.toString().replace(check, function(matchedText,a,b){
      return ('<strong>' + matchedText + '</strong>');
  });
});
Vue.prototype.$base_url = window.location.origin;
Vue.prototype.$hostapi_url = window.location.origin + "/api/dashboard";
Vue.prototype.$config={headers: { Authorization: `Bearer `+authUser.api_token }};

const app = new Vue({
    el: '#app',
    router,
});
