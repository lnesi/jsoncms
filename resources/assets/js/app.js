
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
Vue.use(VeeValidate);
Vue.use(VueResource);
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('modal', require('./components/Modal.vue'));

const Home = require('./components/pages/Home.vue');
const Partners = require('./components/pages/Partners.vue');
const EditPartner = require('./components/pages/EditPartner.vue');

const routeList = [
  { path: '/', component: Home },
  { path: '/partners', component: Partners },
  { path: '/partners/:id', component: EditPartner }
]

const router = new VueRouter({
  routes:routeList
});

const app = new Vue({
    el: '#app',
    component:["modal"],
    router:router
});
