<template>
    <div>
        <div class="container">
            <div>
                <div v-show="showModal">
                    <app-modal></app-modal>
                </div>
                <form v-show="!showModal" @submit.prevent="OnSubmit">
                    <div class="form-group">
                        <label for="staticEmail" >Name</label>
                        <input type="text"  id="staticEmail" class="form-control" v-model="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="price">price</label>
                        <input type="text" class="form-control" id="price" v-model="price" placeholder="price">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" class="form-control" id="quantity" v-model="quantity" placeholder="quantity">
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" class="form-control" id="company" v-model="company" placeholder="company">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" v-model="type">
                            <option>category</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" @click="showModal = true">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Modal from './modal.vue';
import axios from 'axios';
export default {
    data(){
        return{
            showModal: false,
            name:'',
            price:'',
            quantity:'',
            company:'',
            type:''
        }
    },
    components:{
        'app-modal':Modal
    },
    methods:{
        OnSubmit(){
                axios.post('/additem',{
                    name:name,
                    price:price,
                    quantity:quantity
                })
        }
    }
    
}   
</script>
<style>
.row{
    margin-left: 30px;
    
}
.container{
    border:black 2px;
}

</style>


