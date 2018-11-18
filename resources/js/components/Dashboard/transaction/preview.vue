<template>
<div class="preview">
    <p>Transaction ID: {{transactionId}}</p>
       <table class="striped">
        <thead>
          <tr>
              <th>Name</th>
              <th>Item Code</th>
              <th>Item Price</th>
              <th>Quantity</th>
              <th>Sub Total</th>
              <th></th>
          </tr>
        </thead>
        <tbody>
            <tr v-for="item in items">
                <td>{{item.item_name}}</td>
                <td>{{item.item_id}}</td>
                <td>{{item.rate}}</td>
                <td>{{item.qty}}</td>
                <td>{{item.total}}</td>
                <td class="delete" @click="deleteItem(item)" >
                    <div>
                        <i class="material-icons red-text">close</i>
                    </div>
                </td>
            </tr>
           
        </tbody>
       
       </table>
         <div class="row">
             <div class=" col m3 offset-m6">Total : </div><div class="col m2"> {{total}}</div>
            </div>
</div>
</template>

<script>
import axios from 'axios';
export default {
    

    data(){
        return {
        items:[{}],
        bill:{},
        allItems:[{}],
    }
    },
    props:{
        transactionId:{
            type:String
        },
        flag:{
            type:Number
        },
        user:{
            type: Array
        }

    },
    // updated: function(){
        
    //       this.fetchItems();
    // },
    watch:{
        flag: function(ov,nv){
            this.fetchItems();
        }
    },
    computed:{
        total:function(){
            var x=0;
            for(var i=0;i<this.items.length;i++){
                x=x+parseFloat(this.items[i].total);
            }
            return x;
        }
    },
    methods:{
        deleteItem(item){
            axios.post(backend+'/del-item-transaction',{
                'tran_id' :item.id
            }).then(
                (response) => {
                    console.log(response);
                      M.toast({html: 'Item deleted'}) ;
                    this.fetchItems();
                }
            )
        },
        fetchItems(){
            axios.post(backend+'/get-transaction',{
                'transaction_id' : transactionId,
            },{
                headers:[
                   
                ]
            }).then(
                (response) => {
                    this.items=response.data.transactions;
                    console.log(this.items)
                    this.bill=response.data.bill;
                   //  this.getItemNames();

                }
            ).catch(function(error){
                console.log(error)
            })
           
        },
       
    }

}
</script>

<style >
table{
    line-height: 12px;
    font-size:12px;
}
tr{
    padding-top: 0px;
    padding-bottom: 5px;
}
td{
    padding:6px 6px;
}
tbody tr:hover{
    font-size: 15px;
    background-color: rgba(255, 255, 0, 0.544)!important;
}
.delete:hover{
    background-color: rgba(0, 0, 255, 0.17);
}

.delete div i{
    font-size: 12px!important;
    line-height: 12px!important;
}
.preview{
min-height:60vh!important;
}


</style>

