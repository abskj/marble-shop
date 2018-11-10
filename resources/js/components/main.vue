<template>
   <div class="container">
       <div v-if="logged_in">
           <app-dashboard @logout="logout"></app-dashboard>
       </div>
       <div v-else>
           <app-login @login-successful="LoginSuccess"></app-login>
       </div>
       <app-register></app-register>
       <!-- Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non reprehenderit distinctio expedita sit unde dolorem consequuntur animi, eos error cupiditate veniam dignissimos sequi, perferendis quae? Quod temporibus sapiente voluptatem molestias! -->
   </div>
</template>

<script>
import Register from './registration.vue';
import Login from './Login/login.vue';
import Dashboard from './Dashboard/dashboard.vue';
    export default {
        data(){
            return{
                logged_in:false,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        components:{
            'app-register' : Register,
            'app-login':Login,
            'app-dashboard':Dashboard,
       },
       methods:{
           LoginSuccess(){
               this.logged_in=true;
           }
       },
       logout(){
           this.logged_in=false;
       }
    }
</script>
