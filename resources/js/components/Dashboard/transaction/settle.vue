<template>
     <div>
         <div class="modal-content">
                   <div class="center">
                        <h4>SETTLE THE TRANSACTION</h4>
                   </div>
                    <p>Powered by TechBongo</p>
                    </div>
                  <form @submit.prevent="settle">
                          <div class="row">
                            <div class="row">
                                <div class="col m3 offset-m1">
                                <div style="margin-top:25px;">
                                    Choose Payment Option
                                </div>
                            </div>
                            <div class="input-field col m4 ">
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
       
       
    },
    data(){
        return {
            //0 cash
            //1 card
            settle_flag:0,
            card_no:0,
            bank: '',
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
            axios.post(backend+'/settle',{
                'tran_id' : this.tranId,
                'settle_mode' : this.settle_flag,
                 'card_number':this.card_no,
                 'bank':this.bank,
            }).then((response)=>{
                M.toast({html:'Transaction completed'})
                document.getElementsByTagName("body")[0].style.overflow="auto";
                                axios.post(backend+'/printTest',{
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

<style>

</style>
