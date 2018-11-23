<template>

       <div class="col s12">
        
  <nav>
    <div class="nav-wrapper purple darken-4 ">
      <a href="#" class="brand-logo thin" style="padding:2px;padding-left:5px;">TECHBONGO</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
                     <li class="nav-item"><router-link to='./additem'>Add Item</router-link></li>
                    <li class="nav-item"><router-link to='./addcategory'>AddCategory</router-link></li>
                    <li class="nav-item"><router-link to='./transaction'>Transaction</router-link></li>
       
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
