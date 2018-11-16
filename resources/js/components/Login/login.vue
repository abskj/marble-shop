<template>
    <div class="container">
        <form @submit.prevent="OnSubmitted">
            <div class="form-group row">
                <label for="exampleInputEmail1">User Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="exampleInputEmail1" v-model="username" placeholder="username">
                </div>
            </div>
            <div class="form-group row">
                <label for="exampleInputPassword1">Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" v-model="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
import axois from 'axios';
export default{
    data(){
        return{
            username:'',
            password:''
        }
    },
    methods:{
        OnSubmitted(){
            axios.post('/user/login',{
                user_name:this.username,
                password:this.password
            },
            )
            .then(response=>{
                this.$emit('login-successful');
            }).catch(function(error){
                console.log(error);
            });
        }
    }
}
</script>
