<template>
    <div >
       <div class="row">
           <div class="col s12">
              
                   <app-nav></app-nav>
               </div>
              
           </div>
           <div class="row">
               <div class="col s12">
                   <router-view :user="user" ></router-view>
               </div>
           </div>
    </div>

</template>
<script>
import Navbar from './navbar.vue';

export default{
    components:{
        'app-nav':Navbar,
    },
    data(){
        return {
            user:[
                {
                    'user_name': 'test',
                    role: 1
                }
            ]
        }
    }
}
</script>