<template>
    <div id="trans">
         <!-- <div id="activeTransactions" class="row">
             <app-active-transactions v-on:changeActive="retrieveActive" v-bind:list="active"></app-active-transactions>
         </div> -->
        <div class="row">
            <h4 class="heading container ">
            Transaction
        </h4>
        </div>
        <div class="row ">
            <div class="col s12 m6">
                <form action="" class="" @submit.prevent="transactionSubmit">
                     <div class="row ">
                        <div class="col m5 label">
                            Customer Mobile Number:
                        </div>
                        <div class="col m5">
                            <input @blur="getCustomerInfo" @keypress.enter.prevent="getCustomerInfo" type="number" minlength="10"  id="customer_no" v-model="cust_no">
                        </div>
                    </div>
                    <!--
                        hidden input for tranid
                        -->
                        <input type="hidden" id="transactionId" v-model="tran_id">
                    <div class="row ">
                        <div class="col m5 label">
                            Customer Name:
                        </div>
                        <div class="col m5">
                            <input type="text" name="" id="customer_name" v-model="cust_name">
                        </div>
                    </div>
                   
                   
                    <div class="row">
                        <div class="col m5 label">
                            Customer Address:
                        </div>
                        <div class="col m5">
                            <input type="text" id="customer_addr"  minlength="10" maxlength="200" name="" v-model="cust_addr">
                        </div>
                    </div>

                    <div class="row container shadow">
                       <!--  -->
                    <add-to-bill v-bind:flag="resetController" v-bind="items" v-bind:user="user" v-on:item-added="fillitems"></add-to-bill>

                    </div>
                                 <div class="row">
                                    <div class="row">
                                       <div class="col m3 label">
                                              Discount Rate:
                                      </div>
                                        <div class="col m3">
                                                <input type="number" step="0.01" name="" max="100" id="drate"  v-model="discount_rate">
                                        </div>
                                      
                                    </div>
                                </div>
                   
                    <div class="row container">
                        <div class="col m6">
                           <div class="row"></div>
                            <button id="trans-submit" type="submit" class="btn waves green">Finish Transaction</button>
                        </div>
                        <div class="col m6">
                            <div class="row">
                                <button id="trans-reset" style="margin-top:9px;" @click="reset" class="btn waves blue">New Transaction</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col s12 m6 shadow">
               
                <div>
                   <app-preview v-bind:user="user" v-bind:transactionId="this.tran_id" v-bind:flag="previewControl"></app-preview>
                </div>
            </div>
            
        </div>
        <div id="modal1" class="modal">
           
                   <settle-bill v-on:complete="finish" v-bind:tranId="this.tran_id" v-bind:flag="settlementControl"></settle-bill>
         </div>
        
    </div>
</template>

<script>
import Preview from './transaction/preview.vue';
import axios from 'axios';
import addtoBill from './transaction/addToBill.vue';
import Settle from './transaction/settle.vue';
import ActiveTran from './transaction/activeTran.vue';
export default {

     props:{
        user:{
            type: Array
        },
        loginControl:{
            type: Boolean
        }
    },
    components:{
        'app-active-transactions' : ActiveTran,
        'add-to-bill':addtoBill,
         'app-preview' : Preview,
         'settle-bill' : Settle,
    },
    data(){
        return{
            active:[{}],
            previewControl:0,
            cust_no:'',
            cust_addr:'',
            cust_exists:false,
            cust_name:'',
            item_name:'',
            items:[{}],
            item_code:'',
            item_rate:'',
            item_quantity:0,
            first_tran:1,
            tran_id:'',
            food_cat:'',
            discount_rate:0.00,
            resetController:1,
            settlementControl:0,

        }
    },
    watch:{
        tran_id:{
            handler : function(nu,old){
                if(old===''){
                     
                    this.first_tran=0;
                    this.cust_exists=true;
                     this.disableTransFields()
                   
                }
                else{
                   if(nu===''){
                         this.first_tran=1;
                     
                      this.enableTransFields()
                   }
                   else{
                       this.first_tran=0;
                       this.cust_exists=true;
                       this.disableTransFields();
                   }
                    
                }
            }
        },
      
    },
    created: function(){
        setInterval(this.initActiveTrans(),5000)      
    },
    methods:{
        initActiveTrans(){
             axios.post(backend+'/activeTrans', {
                                       
                                        'user_name' :this.user[0]['user_name'],
                                        'branch_id':this.user[0]['branch_id'],
                                       

                                    },{
                                        headers:[]
                                    }).then(
                                     
                                        (response)=> {
                                            this.active=[{}];
                                            console.log(response.data.activeTransactions[0].tran_id)
                                          response.data.activeTransactions.forEach(element => {
                                                this.active.push({
                                                tran_id: element.tran_id,
                                                cust_no:element.cust_no,
                                                cust_name:element.cust_name,
                                                addr: element.addr,
                                                discount : element.discount,
                                            })
                                          });
                                                                        
                                        }

                                    ).catch(function (error) {
                                        console.log(error);
                                    })
          
            ///uygtuy
        },
        disableTransFields(){
            this.disableCustFields();
              document.getElementById('customer_no').disabled=true;
            // document.getElementById('drate').disabled=true;

        },
        enableTransFields(){
            this.enableCustFields();
              document.getElementById('customer_no').disabled=false;
            // document.getElementById('drate').disabled=false;

        },
        disableCustFields(){
            document.getElementById('customer_name').disabled=true;
            document.getElementById('customer_addr').disabled=true;
        },
        enableCustFields(){
             document.getElementById('customer_name').disabled=false;
            document.getElementById('customer_addr').disabled=false;
        },
        retrieveActive(tran){              
                this.reset();
                this.tran_id= tran.tran_id;
                this.cust_no=tran.cust_no;
                this.cust_name=tran.cust_name;
                this.cust_addr= tran.addr;               
                this.discount_rate = tran.discount;
                this.previewControl++;        

        },
        insertIntoActive(){
            this.active.push({
                tran_id: this.tran_id,
                cust_no:this.cust_no,
                cust_name:this.cust_name,
                addr: this.cust_addr,
                discount : this.discount_rate * 100,
            })
        },
        removeFromActive(){
            for(var i=0;i<this.active.length;i++){
                
                if(this.active[i].tran_id===this.tran_id){
                    
                    this.active.splice(i,1);
                    break;
                }
            }
        },

        finish(){
            var elem=document.getElementById('modal1');
             var instance = M.Modal.getInstance(elem);
             instance.destroy()
              M.toast({html: 'Collect your Bill'}) ;
              this.removeFromActive();
             
             this.reset();

        },
        reset(){
             this.previewControl++;
             this.cust_no='';
              this.cust_addr='';
              this.cust_exists=false;
               this.cust_name='';
             this.item_name='';
             this.items=[{}];
               this.item_code='';
               this.item_rate='';
            this.item_quantity=0;
             this.first_tran=1;
              this.tran_id='';
           this.food_cat='';
           this. discount_rate=0.00;
           this.resetController++;
           this.enableTransFields();

           

        },
        fillitems(code,qty){
            console.log('add to button pressed')
            this.item_code=code;
            this.item_quantity=qty;
            
            if(this.first_tran===1){
            console.log('first transaction')
                
               if(this.cust_exists===false){
                     console.log('new customer')
                   //add customer
                            axios.post(backend+'/customerCreate', {
                            'mobile': this.cust_no,
                            'name' :this.cust_name,
                            'address':this.cust_addr,
                        },{
                            headers:[]
                        }).then(
                            () => {
                                this.cust_exists=true;
                                M.toast({html: 'Customer added'}) ;
                                 //initialize transaction
                                    axios.post(backend+'/start-transaction', {
                                        'cust_id': this.cust_no,
                                        'user_name' :this.user[0]['user_name'],
                                        'branch_id':this.user[0]['branch_id'],

                                    },{
                                        headers:[]
                                    }).then(
                                     
                                        (response)=> {
                                            this.tran_id=response.data.id;
                                             M.toast({html: 'Transaction started'}) ;
                                             this.first_tran=0;
                                             this.previewControl++;
                                             this.insertIntoActive()
                                               this.addItemToBill()
                                        }

                                    ).catch(function (error) {
                                        console.log(error);
                                    })
                                   
                                        },

                        ).catch(()=> {
                              M.toast({html: 'There was some problem while communicating'})
                        });
                       

                       
               }
               else{
                    axios.post(backend+'/start-transaction', {
                                        'cust_id': this.cust_no,
                                        'user_name' :this.user[0]['user_name'],
                                        'branch_id':this.user[0]['branch_id'],
                        'steward_id' :this.steward_id,
                        'table_no' : this.table,
                                    },{
                                        headers:[]
                                    }).then(
                                     
                                        (response)=> {
                                            this.tran_id=response.data.id;
                                             M.toast({html: 'Transaction started'}) ;
                                             this.first_tran=0;
                                             this.previewControl++;
                                             this.insertIntoActive()
                                               this.addItemToBill()
                                        }

                                    ).catch(function (error) {
                                        console.log(error);
                                    })

               }  
                

            }
            else{
                this.addItemToBill()
            }

        },
       
        transactionSubmit(){
           
            axios.post(backend+'/complete-transaction',{
                'transaction_id' :this.tran_id,
                'discount_rate' :this.discount_rate/100,
            }).then(
                (response) =>{
                     var elems=document.getElementById('modal1');
                   this.settlementControl++;
                       var modal=M.Modal.init(elems, {
                            'startingTop': '25%',
                             'dismissible' :true,
                                 })
                      modal.open()
                      
                }
            ).catch(function(err){
                console.log(err);
            })
           
           

        },
        getCustomerInfo(){

            axios.post(backend+'/customer', {
                'mobile': this.cust_no,
            },{
                headers:[]
            }).then(
                response=>{
                    this.cust_no=response.data.customer_mobile,
                    this.cust_id=response.data.customer_id,
                    this.cust_addr=response.data.customer_addr,
                    this.cust_name=response.data.customer_name,
                    this.cust_exists=true;
                    this.disableCustFields();
                }
            ).catch((error)=>
            {
                
                    this.cust_id='',
                    this.cust_addr='',
                    this.cust_name='',
                    this.cust_exists=false;
                    this.enableCustFields();
            }
            
            );
        },
        addItemToBill(){
               axios.post(backend+'/part-transaction', {
                            'cust_id': this.cust_no,
                            'user_name' :this.user[0]['user_name'],
                            'branch_id':this.user[0]['branch_id'],
                            'cat_id':this.food_cat,
                            'qty':this.item_quantity,
                            'rate':this.item_rate,
                            'tran_id':this.tran_id,
                            'item_id':this.item_code,
                            'item_name':this.item_name,


                        },{
                            headers:[]
                        }).then(
                            (response) => {
                                 M.toast({html: 'Added to bill'});
                                  this.resetController++;
                                 this.previewControl--;
                                

                            }
                        ).catch(function (error) {
                             M.toast({html: 'Some Error Occured'});
                            console.log(error);
                        })
        }
      
    }

}
</script>

<style >
.row{
    width: 100%;
}
div:hover{
    border: 1px red solid;
}

#trans input{
    color:black!important;
    height: 1.2em;
    margin-bottom: 1px;
    border:1px solid grey!important;
    background-color: rgba(214, 214, 214, 0.316)!important;
    border-radius:3px; 
    padding: 3px!important;
}

#trans input:focus{
    color:black!important;
}
#trans form{
    margin: 10px;
}
#trans * .row
{
    margin-bottom: 10px;
}
.label{
    
    font-weight: 600;
}
#activeTransactions{
    position: fixed;
    overflow-y: scroll;
    overflow-wrap: normal;
    border: 1px solid black;
    top: 5em;
    left: 0px;
    color:white;
   max-height: 85vh;
   width: 15vw;
}




</style>
