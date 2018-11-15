<template>
    <div>
        <div class="container" style="border:2px black;">
            <div class="col-md-8 form ">
                <form @submit.prevent="Onsubmit">
                    <div class="form-group">
                        <label for="addcategory">Add Category</label>
                        <input type="text" class="form-control" id="addcategory" v-model="category" placeholder="category name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{
            category:'',
        }
    },
    methods:{
        Onsubmit(){
            axios.post('/category',{
                category:this.category,
            })
            .then(function (response){
                console.log(response);
            }).catch(function(error){
                console.log(error);
            });
        }
    }

}
</script>

<style>

.form{
    margin-left:30px ;
    /* border:5px black ; */
    font-size: 25px;
    
}
input:focus{
    border-radius: 5px;
}

</style>
