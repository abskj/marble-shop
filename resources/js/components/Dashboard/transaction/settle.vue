<template>
     <div class="container">
         <div class="modal-content green lighten-3 shadow" style="width:100%">
                   <div class="">
                       <div class="center">
                        <h3 class="heading thin">
                            SETTLE THE TRANSACTION
                        </h3>
                   </div>
                    <p>Powered by TechBongo</p>
                    </div>
                   </div>
                  <form @submit.prevent="settle">

                          <div class="row">
                              <div class="row">
                                 <div class="col m3">
                                      <label for="">
                                          Amount Billed:</label> <h4 class="blue-text">
                                             ₹ {{billedAmt}}
                                          </h4>
                                 </div>
                                 <div class="col m3">
                                     <label for=""> Amount Due</label>
                                     <h4 class="red-text">
                                         ₹ {{billedAmt - amount_paid}}
                                     </h4>
                                 </div>
                                 <div class="col m4">
                                     <label for="amtpaid">Amount Paid</label>
                                     <input type="number" step="0.01" :min="0" :max="billedAmt" v-model="amount_paid" id="amtpaid">
                                 </div>
                              </div>
                            <div class="row">
                                <div class="col m3">
                                <div style="margin-top:25px;">
                                    Choose Payment Option
                                </div>
                            </div>
                            <div class="input-field col m3 ">
                                <select class="browser-default" v-model="settle_flag">
                                
                                <option @click="showBankDetails" value="1">Card</option>
                                <option @click="hideBankDetails" value="0" selected>Cash</option>
                            
                                </select>
                            
                            </div>
                          </div>
                          <div v-bind:class="listClassObject1">
                              <div style="margin-top:15px;" class="row">
                             <div class="col m3 offset-m1">
                                 Card Number:
                             </div>
                             <div class="col m4 ">
                                  <input type="number" name="" id="" v-model="card_no">
                             </div>
                          </div>
                          <div style="margin-top:15px;" class="row">
                             <div class="col m3 offset-m1">
                                Bank name:
                             </div>
                             <div class="col m4 ">
                                  <input type="text" maxlength="30" name="" id="" v-model="bank">
                             </div>
                          </div>
                          </div>
                          <div class="row">
                              <div class="center">
                                  <button class="green btn-large btn waves white-text" type="submit">Settle</button>
                              </div>
                          </div>
                      </div>
                      
                  </form>
                
                    
     </div>
</template>

<script>
 import axios from "axios";
export default {
   
    props: {
        tranId:{
            type: String
        },
        flag:{
            type:Number
        },
        billedAmt:{
            type:Number
        }
    },
    watch:{
        flag: {
            handler: function(oldVal, newVal){
                this.settle_flag=0;
                this.card_no=0;
                this.bank=0;
            }
        },
        amount_paid:{
            handler: function(nu,old){
                if(nu<0){
                    this.amount_paid =old
                }
                if(nu>this.billedAmt){
                    this.amount_paid = old
                }
            }
        }
       
       
    },
    data(){
        return {
            //0 cash
            //1 card
            settle_flag:0,
            card_no:0,
            bank: '',
            amount_paid:'',
            listClassObject1:{
                hide:true,
            },
        }
    },
    methods:{
        showBankDetails(){
            this.listClassObject1.hide=false
        },
         hideBankDetails(){
            this.listClassObject1.hide=true
        },
        settle(){
            axios.post('/api/settlement/settle',{
                'tran_id' : this.tranId,
                'settle_mode' : this.settle_flag,
                'amount_paid' : this.amount_paid,
                 'card_number':this.card_no,
                 'bank':this.bank,
            }).then((response)=>{
                M.toast({html:'Transaction completed'})
                document.getElementsByTagName("body")[0].style.overflow="auto";
                                axios.post('api/settle/generate',{
                                'tran_id' :this.tranId,
                               
                            }).then(
                                (response) =>{
                                   console.log(response)
                                    
                                }
                            ).catch(function(err){
                                console.log(err);
                            })
                this.$emit('complete')
            }).catch(function(err){
                 console.log(err)
                M.toast({html:'Transaction failed'})
            })
               
            
        },
    }

}
</script>

<style scoped>
.parent{
    padding:10px;
}
</style>
