
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
Vue.component('alert', require('./components/Alert.vue'))
Vue.component('confirm', require('./components/Confirm.vue'));
Vue.component('preloader', require('./components/Preloader.vue'));


const Home = require('./components/pages/Home.vue');
const Partners = require('./components/pages/Partners.vue');
const EditPartner = require('./components/pages/EditPartner.vue');
const Error400 = require('./components/pages/Error400.vue');
const Error404 = require('./components/pages/Error404.vue');


const routeList = [
  { path: '/', component: Home },
  { path: '/partners', component: Partners },
  { path: '/partners/:id', component: EditPartner },
  { path: '/400', component: Error400 },
  { path: '*', component: Error404 }
]


const router = new VueRouter({
  routes:routeList
});



window.app = new Vue({
    el: '#app',
    component:["modal","alert","confirm","preloader"],
    router:router,
    methods:{
    	alert:function(event){
    		console.log("HI");
    	}
    },
    mounted(){
    	console.log("APP INIT");
    	this.$router.beforeEach((to, from, next) => {
		  this.$emit("SHOW_PRELOADER");
		  next();
		});
		this.$router.afterEach((to, from) => {
		  this.$emit("HIDE_PRELOADER");
		});
		this.$emit("HIDE_PRELOADER");
    }

});

