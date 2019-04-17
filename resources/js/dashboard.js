window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.toastr = require('toastr');

require('bootstrap');
require('./libs/smartresize');
require('./custom');

window.token = $('meta[name="csrf-token"]').attr('content');

if (!token) {
    console.error('CSRF token not found');
}

window.toastr.options = {
    "timeOut": 10000,
    "closeButton": true,
    "progressBar": true,
    "hideMethod": "slideUp",
    "closeDuration": 300,
    "extendedTimeOut": 5000
};
