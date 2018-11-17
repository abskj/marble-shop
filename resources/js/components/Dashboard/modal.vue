<template>
    <div>
        <form>
            <legend>Image Upload</legend>
            <div class="form-group">
                <label for="image" >Upload Image</label>
                <input type="file"  id="image" class="form-control" placeholder="Image">
            </div>
            <button type="submit" class="btn btn-primary" @click="showModal = false">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            // OpenModal:false
        }
    },
}
</script>

<style>


</style>
