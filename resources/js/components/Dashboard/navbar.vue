<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="row">
                <ul class="navbar-nav " >
                    <li class="nav-item"><router-link to='./transaction'>Transaction</router-link></li>
                    <li class="nav-item"><router-link to='./additem'>Add Item</router-link></li>
                    <li class="nav-item"><router-link to='./addcategory'>AddCategory</router-link></li>
                    <li class="nav-item"><router-link to='./other'>Other</router-link></li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
export default {

}
</script>

<style>
    .nav-item{
        margin-left:30px;
        font-size: 30px;
    }
</style>
