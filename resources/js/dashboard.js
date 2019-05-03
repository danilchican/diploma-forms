window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.toastr = require('toastr');
window.Vue = require('vue');

require('bootstrap');
require('./libs/smartresize');
require('./custom');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found.');
}

window.toastr.options = {
    "timeOut": 10000,
    "closeButton": true,
    "progressBar": true,
    "hideMethod": "slideUp",
    "closeDuration": 300,
    "extendedTimeOut": 5000
};

Vue.component('create-form', require('./components/CreateFormComponent.vue').default);
Vue.component('edit-form', require('./components/EditFormComponent.vue').default);

const app = new Vue({
    el: '#app'
});
