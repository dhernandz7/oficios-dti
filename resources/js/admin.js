require('./bootstrap');
require('../plugins/sbadmin2/vendor/jquery-easing/jquery.easing.min.js');
require('../plugins/sbadmin2/js/sb-admin-2.js');
require('../plugins/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js');

window.Swal = require('sweetalert2');
window.moment = require('moment');
window.Vue = require('vue');

Vue.component('app-component', require('./components/AppComponent.vue').default);

import router from './routes'

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

const app = new Vue({
    el: '#app',
    router
});