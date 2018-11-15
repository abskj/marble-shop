<template>
    <div>
        <h1>
            Dashboard
        </h1>
        <div class="container">
            <div class="row">
                <app-nav/>
            </div>
        </div>
        <div>
            <router-view></router-view>
        </div>
        
        
    </div>
</template>
<script>
import Navbar from './navbar.vue';

export default{
    components:{
        'app-nav':Navbar,
    }
}
</script>