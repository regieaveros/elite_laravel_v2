/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Form from './Form';

window.Form = Form;

window.$ = require('jquery');

require('datatables.net-dt/js/dataTables.dataTables.min.js');
require('datatables.net-dt/css/jquery.dataTables.min.css');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Dashboard
Vue.component('dashboard-view', require('./components/dashboard/View.vue').default);
Vue.component('dashboard-show', require('./components/dashboard/Show.vue').default);

//Usertype
Vue.component('usertype-view', require('./components/usertype/View.vue').default);
Vue.component('usertype-create', require('./components/usertype/Create.vue').default);
Vue.component('usertype-edit', require('./components/usertype/Edit.vue').default);

//User
Vue.component('user-view', require('./components/user/View.vue').default);
Vue.component('user-create', require('./components/user/Create.vue').default);
Vue.component('user-edit', require('./components/user/Edit.vue').default);

//Document
Vue.component('document-view', require('./components/document/View.vue').default);
Vue.component('document-create', require('./components/document/Create.vue').default);
Vue.component('document-edit', require('./components/document/Edit.vue').default);

//Rank
Vue.component('rank-view', require('./components/rank/View.vue').default);
Vue.component('rank-create', require('./components/rank/Create.vue').default);
Vue.component('rank-edit', require('./components/rank/Edit.vue').default);

//Crew
Vue.component('crew-view', require('./components/crew/View.vue').default);
Vue.component('crew-create', require('./components/crew/Create.vue').default);
Vue.component('crew-edit', require('./components/crew/Edit.vue').default);
Vue.component('crew-show', require('./components/crew/Show.vue').default);
Vue.component('crew-modal', require('./components/crew/Modal.vue').default);

//Nav Item
Vue.component('nav-item', require('./components/NavItem.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});