
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Main from './components/main.vue';
require('./bootstrap');
import VueRouter from 'vue-router';
// import { library } from '@fortawesome/fontawesome-svg-core'
// import { faCoffee } from '@fortawesome/free-solid-svg-icons'
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
// library.add(faCoffee)

// Vue.component('font-awesome-icon', FontAwesomeIcon)

// Vue.config.productionTip = false

window.Vue = require('vue');
Vue.use(VueRouter);
/**
 * the vuejs router
 */
const routes = [
    { path: '', component: Main,
    children:[
      
      
    ]
  },
    
   
  ];
  
  const router = new VueRouter({
    mode: 'history',
    routes: routes
  });

  
Vue.component('example-component', require('./components/main.vue'));

const app = new Vue({
    el: '#app'
});
