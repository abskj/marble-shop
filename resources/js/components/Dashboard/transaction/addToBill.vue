<template>
    <div>
         <form @submit.prevent="addItems">
                            <div class="col m12">
                                
                                
                                <div class="row">
                                    <div class="row">
                                       <div class="col m4 label">
                                              Food Category:
                                      </div>
                                        <div class="col m4">
                                                <input disabled type="text" minlength="10" maxlength="200"    v-model="food_cat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="col m2 label">
                                                Item:
                                        </div>
                                        <div class="col m4">
                                             
                                            <div class="row">
                                                      <input autocomplete="off" type="text" @keydown.enter.prevent="selectItem" @keyup.up.prevent="changeSelect(-1)" @keyup.down.prevent="changeSelect(+1)"  v-model="item_name" @focus="getItems" @blur="hideItemList" id="item-search-text">
                                            </div>
                                               <div class="row white ">
                                      
                                                    <ul id="item-list" v-bind:class="listClassObject">
                                                        <li v-for="item,index in items" @mousedown="selectItemC(index)">
                                                         
                                                            {{item.item_name}}
                                                           
                                                        </li>
                                                    
                                                    </ul>
                                                </div>
  
                                        </div>

                                        <div class="col m6">
                                            <div class="row">
                                                <div class="col m3 label">
                                                        Code:
                                                </div>
                                                <div class="col m3">
                                                    <input disabled  v-model="item_code">
        
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                  
                                </div>  
                                <div class="row">
                                    <div class="row">
                                       <div class="col m4 label">
                                              Item Quantity:
                                      </div>
                                        <div class="col m3">
                                                <input min="1" type="number"  name=""    v-model="item_quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                       <div class="col m3 label">
                                              Item Rate:
                                      </div>
                                        <div class="col m3">
                                                <input disabled type="number" step="0.01" name=""    v-model="item_rate">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="center">
                                        <button type="submit" id="addToBillButton" class="btn red">Add to Bill</button>
                                    </div>
                                   
                                </div>

                            </div>
                        </form>
    </div>
</template>

<script>

import axios from 'axios';
export default {
         props:{
        user:{
            type: Array
        },
             flag:{
            type: Number
             }
    },
        components:{
       
       
    },
    data(){
        return {
            listClassObject:{
                hide: true,
            },
            select:1,
             item_name:'',
            items:[{}],
            item_code:'',
            item_rate:'',
            item_quantity:0,
            first_tran:1,
            tran_id:'',
            food_cat:'',
            allItems:[{}],
        }
    },
    computed:{
        
    },
    watch:{
        item_name:{
           handler:  function(oldval,newval){
             while(this.items.length>0){
                 this.items.pop()
             }
            console.log(this.allItems)

            for(var i=0;i< this.allItems.length;i++){
                   var temp=this.allItems[i].item_name.toLowerCase().indexOf(this.item_name.toLowerCase());
                   if(temp>-1){
                       this.items.push(this.allItems[i])
                   }
                }  
                var elements=document.getElementById("item-list").children;
                console.log(this.select-1)
                elements[this.select-1].classList.add('selected');
        }
        },
        select:{
           handler: function(oldval,newval){
               if(newval===0){
                   this.select=this.items.length;
               }
                if(newval>=this.items.length){
                    this.select=1;
                }
                 var elements=document.getElementById("item-list").children;
                for (var i=0;i<elements.length;i++){
                    elements[i].classList.remove('selected')
                }
                elements[this.select-1].classList.add('selected');
           }
        },
        flag:{
            handler: function (oldval,newval) {
                    this.listClassObject.hide=true;
                    this.select=1;
                    this.item_name='';
                    this.items=[{}];
                    this.item_code='';
                    this.item_rate='';
                    this.item_quantity=0;
                    this.first_tran=1;
                    this.tran_id='';
                    this.food_cat='';
                    this.allItems=[{}];
                    document.getElementById('addToBillButton').disabled=false
            }
        }
    },
    methods:{
        hideItemList(){
            this.listClassObject.hide=true;
        },
            changeSelect(x){
                this.listClassObject.hide=false;
                console.log(x)
               this.select=this.select+x;
               
            },
             getItems(){
               
            
             axios.post(backend+'/get-foodItem', {
                'user_name':this.user[0]['user_name'],
                'role': this.user[0]['role'],
                'branch_id':this.user[0]['branch_id'],
            },{
                headers:[]
            }).then((response) => {
                this.code=response.data.code;
            this.allItems=response.data.data;
            this.listClassObject.hide=false;
        }

            ).catch(function (error) {
                console.log(error);
            })
        },
        isSelected(index){
            if((index+1)===this.select){
                return true;
            }
            else{
                return false;
            }
        },
        selectItemC(index){
            this.select=index+1;
            this.selectItem();
        },
      
       selectItem(){
           var item=this.items[this.select-1];
           this.item_name=item.item_name;
           this.item_code=item.item_id;
           this.food_cat=item.cat_id;
           this.item_rate=item.item_rate;
          this.items=[{}];
          document.getElementById('item-search-text').value=item.item_name;
          this.listClassObject.hide=true;
        },
    
   addItems(){
        document.getElementById('addToBillButton').disabled=true
        this.$emit('item-added',this.item_code,this.item_quantity);
    },

    
}
}
</script>

<style>
.selected{
    background-color: rgba(97, 252, 120, 0.905);
}
</style>
