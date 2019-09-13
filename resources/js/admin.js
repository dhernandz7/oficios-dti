window.$ = window.jQuery = require('../plugins/sbadmin2/vendor/jquery/jquery.min.js');
require('../plugins/sbadmin2/vendor/bootstrap/js/bootstrap.min.js');
require('../plugins/sbadmin2/vendor/jquery-easing/jquery.easing.min.js');
require('../plugins/sbadmin2/js/sb-admin-2.min.js');
window.$.fn.DataTable = require('../plugins/sbadmin2/vendor/datatables/datatables.min.js');
window.$.fn.DataTable = require('../plugins/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js');
window.Swal = require('../../node_modules/sweetalert2/dist/sweetalert2.min.js');


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.moment = require('moment');

window.Vue = require('vue');
Vue.component('app-component', require('./components/AppComponent.vue').default);
//Vue.component('index-component', require('./components/IndexComponent.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//Vue.component('app-memorandum-component', require('./components/MemorandumsComponent.vue').default);

import router from './routes'

const app = new Vue({
    el: '#app',
    router
});