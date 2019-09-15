//window.$ = window.jQuery = require('../plugins/sbadmin2/vendor/jquery/jquery.min.js');
require('./bootstrap');
//require('../plugins/sbadmin2/vendor/bootstrap/js/bootstrap.min.js');
require('../plugins/sbadmin2/vendor/jquery-easing/jquery.easing.min.js');
require('../plugins/sbadmin2/js/sb-admin-2.min.js');
window.$.fn.DataTable = require('../plugins/sbadmin2/vendor/datatables/datatables.min.js');
window.$.fn.DataTable = require('../plugins/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js');
window.Swal = require('../../node_modules/sweetalert2/dist/sweetalert2.min.js');

window.moment = require('moment');

window.Vue = require('vue');

Vue.component('app-component', require('./components/AppComponent.vue').default);

import router from './routes'

const app = new Vue({
    el: '#app',
    router
});