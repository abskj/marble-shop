<template>
<div>
    <div class="form-centerform-inline">
        <legend class="text-center">Register</legend>
        <form v-on:submit.prevent="OnSubmitted">
            <div class="form-group">
                <label for="exampleInputEmail1">User Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1"  v-model="username" placeholder="user name">
            </div>
            <div class="form-group">
                <label for="firstname">First name</label>
                <input type="text" class="form-control" id="firstname"  v-model="firstname" placeholder="first name">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname"  v-model="lastname" placeholder="last name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" v-model="password" placeholder="Password">
            </div>
                <input type="hidden" name="_token" :value="csrf">
            <div class="form-group">
                <label for="type">Type</label>
                <input type="tinyint" class="form-control" id="type"  v-model="type" placeholder="Type">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return {
            username:'',
            firstname:'',
            lastname:'',
            password:'',
            type:'',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    methods:{
        OnSubmitted(){
            axios.post('http://127.0.0.1:8000/api/user/create',{
                user_name:this.username,
                first_name:this.firstname,
                last_name:this.lastname,
                password:this.password,
                type:this.type
            }).then(function (response){
                console.log(response);
            }).catch(function (error){
                console.log(error);
            });
        }
    }
}
</script>

<style>
    .row{
        margin-left:30px;
    }
</style>
