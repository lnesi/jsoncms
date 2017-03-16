
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
Vue.component('mainnav', require('./components/MainNav.vue'));
Vue.component('tbvue-ajax-dropdown', require('./components/tbvue_ajax_dropdown.vue'));
Vue.component('tbvue-input', require('./components/tbvue_input.vue'));




const Home = require('./pages/Home.vue');
const Partners = require('./pages/Partners.vue');
const EditPartner = require('./pages/EditPartner.vue');
const Audiences = require('./pages/Audiences.vue');
const EditAudience = require('./pages/EditAudience.vue');
const Campaigns = require('./pages/Campaigns.vue');
const EditCampaign = require('./pages/EditCampaign.vue');
const Regions = require('./pages/Regions.vue');
const EditRegion = require('./pages/EditRegion.vue');
const NewDelivery = require('./pages/NewDelivery.vue');

const Error400 = require('./pages/Error400.vue');
const Error404 = require('./pages/Error404.vue');


const routeList = [
  { path: '/', component: Home },
  { path: '/partners', component: Partners },
  { path: '/partners/:id', component: EditPartner },
  { path: '/audiences', component: Audiences },
  { path: '/audiences/:id', component: EditAudience },
  { path: '/campaigns', component: Campaigns },
  { path: '/campaigns/:id', component: EditCampaign },
  { path: '/regions', component: Regions },
  { path: '/regions/:id', component: EditRegion },
  { path: '/delivery/new', component: NewDelivery },
  { path: '/400', component: Error400 },
  { path: '*', component: Error404 }
]


const router = new VueRouter({
  routes:routeList
});

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', window.Laravel.csrfToken);
    next();
});



window.app = new Vue({
    el: '#app',
    component:["modal","alert","confirm","preloader","mainnav","tbvue-ajax-dropdown","tbvue-input"],
    router:router,
    data(){
      return {
        user:{id:null,name:null},
        is_logged:false
      }
    },
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
      this.loadUser();
    },
    methods:{
      loadUser(){
         this.$http.get("ajax/user").then(response => {
            if(response.body){
              this.user=response.body
              this.is_logged=true;
            }
            
         });
      }
    }

});

