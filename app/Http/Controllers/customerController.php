<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;

class customerController extends Controller
{
    //
    public function create(Request $request){
        $this->validate($request,[
             'mobile'=>'required',
            'name'=>'required',
             'address'=>'required',
         ]);
        try{
            $cust=new Customer([
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'address' => $request->input('address'),
            ]);
            $cust->save();
        }catch (\Throwable $e){
            return response()->json([
                'code'=>4,
                'message'=>'customer could not be created',
            ],400);
        }
         // $username = urlencode("DUMMY"); 
         //
         // $msg_token = urlencode("DUMMY"); 
         // $sender_id = urlencode("TKBNGO"); // optional (compulsory in transactional sms) 
         // $message = urlencode("Message".$x."text will be provided"); 
         // $mobile = urlencode($request->input('cust_id')); 
 
         // $api = "http://managed.sms.techbongo.com/api/send_transactional_sms.php?username=".$username."&msg_token=".$msg_token."&sender_id=".$sender_id."&message=".$message."&mobile=".$mobile.""; 
 
         // $response = file_get_contents($api);
        return response()->json([
            'code'=>1,
            'message'=>'customer created successfully',
        ]);
     }

     public function get(Request $request)
     {
         $this->validate($request, [
             'mobile' => 'required'
         ]);
         try {
             $customer = Customer::where('mobile_no', $request->input('mobile'))->get()->first();
             if ($customer === null) {
                 return response()->json([
                     'code' => 5,
                     'message' => 'customer not found'
                 ], 401);
             } else {
                 return response()->json([
                     'code' => 1,
                     'customer_name' => $customer->name,
                     'customer_id' => $customer->id,
                     'customer_mobile' => $customer->mobile_no,
                     'customer_addr' => $customer->address,
                 ]);
             }
 
         } catch (\Throwable $e) {
             return response()->json([
                 'code' => 4,
                 'message' => 'some unknown error occures'
             ], 501);
         }
     }
}
