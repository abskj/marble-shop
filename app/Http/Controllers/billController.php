<?php

namespace App\Http\Controllers;
use App\Bill;
use App\Customer;
use App\user;
use App\part_bill;
use App\product;
use Illuminate\Http\Request;

class billController extends Controller
{
    //
    public function initiateTransaction(Request $request)
    {
        $this->validate($request, [
            'cust_id' => 'required',
        ]);

        $id = null;
        while (true) {
            $y = mt_rand(100, 999);
            $x = date('ymdhi');
            $nu_id = $x . $y;
            $x = Bill::where('id', $nu_id)->count();

            if ($x == 0) {
                $id = $nu_id;
                break;
            }
        }
        $tran = new Bill([
            'id' => $id,
            'cust_id' => $request->input('cust_id'),
            'total' => 0,
            'discount' => 0,
            'final' => 0,
            'amount_paid' => 0,
            'amount_due' => 0,
        ]);
        $tran->save();
        // $username = urlencode("DUMMY"); 
        //
        // $msg_token = urlencode("DUMMY"); 
        // $sender_id = urlencode("TKBNGO"); // optional (compulsory in transactional sms) 
        // $message = urlencode("Message".$x."text will be provided"); 
        // $mobile = urlencode($request->input('cust_id')); 

        // $api = "http://managed.sms.techbongo.com/api/send_transactional_sms.php?username=".$username."&msg_token=".$msg_token."&sender_id=".$sender_id."&message=".$message."&mobile=".$mobile.""; 

        // $response = file_get_contents($api);

        return response()->json([
            'code' => 1,
            'message' => 'Transaction initiated',
            'id' => $id,
        ]);
    }

    public function partTransaction(Request $request)
    {
        $this->validate($request, [
            'bill_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        $iid = $request->input('product_id');
        $item = product::where(['id' => $iid])->first();
        // $cat = $item->cat_id;
        $tran_count = part_bill::where(['bill_id' => $request->input('bill_id'), 'product_id' => $request->input('product_id')])->count();
        if ($tran_count > 0) {
            $tranx = part_bill::where(['bill_id' => $request->input('bill_id'), 'product_id' => $request->input('product_id')])->first();
            $q = $tranx->quantity;
            $new_q = $q + $request->input('quantity');
            $tranx->quantity = $new_q;
            $rate = $tranx->rate;
            $total = $rate * $new_q;
            $tranx->total = $total;

            $tranx->update();
            return response()->json([
                'code' => 1,
                'message' => 'bill updated'
            ]);
        }

        $rate = $item->price;
        $quantity = $request->input('quantity');
        $total = $rate * $quantity;
        $tran = new part_bill([
            'bill_id' => $request->input('bill_id'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'price' => $price,
            ]);

        $tran->save();
        return response()->json([
            'code' => 1,
            'message' => 'bill updated'
        ]);

    }
    public function getPartTransactions(Request $request)
    {
        $this->validate($request, [
            'bill_id' => 'required'
        ]);
        $transactions = part_bill::where('bill_id', $request->input('bill_id'))->get();
        $bill = Bill::where('bill_id', $request->input('bill_id'))->get()->first();

        return response()->json([
            'transactions' => $transactions,
            'bill' => $bill,
            'code' => 1,
        ], 201);
    }

    public function removeItem(Request $request)
    {
        $this->validate($request, [
            'tran_id' => 'required'
        ]);
        try {
            $tran = part_bill::find($request->input('tran_id'));
            $tran->delete();
            return response()->json([
                'code' => 1,
                'message' => 'item removed from list'
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'code' => 3,
                'message' => 'item not found'
            ], 404);
        }
    }
    public function reset(Request $request)
    {
        $this->validate($request, [
            'bill_id' => 'required'
        ]);
        try {
            $transactions = part_bill::where('bill_id', $request->input('bill_id'))->get();
            foreach ($transactions as $tran) {
                $tran->delete();
            }
            return response()->json([
                'code' => 1,
                'message' => 'transactions deleted'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'code' => 4
            ], 404);
        }

    }

    public function complete(Request $request)
    {
        $this->validate($request, [
            'transaction_id' => 'required',
            'discount_rate' => 'required',
        ]);
        $total = 0.00;
        $transactions = part_bill::where('bill_id', $request->input('transaction_id'))->get();
        foreach ($transactions as $tran) {
            $total += ($tran->quantity) * ($tran->price);
        }
        $dr = $request->input('discount_rate');
        $net_total = $total - ($dr * $total);
        $bill = Bill::where('id', $request->input('transaction_id'))->first();
        $bill->discount = $dr * $total;
        $bill->final = $bill->total -$bill->discount;
       
        $bill->save();
        return response()->json([
            'code' => 1,
            'message' => 'transaction completed'
        ]);

    }
}
    // public function settle(Request $request)
    // {
    //     $this->validate($request,
    //         [
    //             'tran_id' => 'required|unique:settlement',
    //             'settle_mode' => 'required',

    //         ]);
    //     $settlement = null;
    //     $tid = $request->input('tran_id');

    //     $bill = DB::table('bill_transaction')->where('tran_id', $tid)->first();

    //     if ($request->input('settle_mode') == 0) {
    //         //assuming 1 for card and 0 for cash
    //         $settlement = new settlement([
    //             'tran_id' => $bill->tran_id,
    //             'customer_id' => $bill->cust_id,
    //             'bill_amount' => $bill->bill_amount,
    //             'settle_mode' => 0,
    //             'status_flag' => 0,


    //         ]);

    //     } else {

    //         //assuming 1 for card and 0 for cash
    //         $settlement = new settlement([
    //             'tran_id' => $bill->tran_id,
    //             'customer_id' => $bill->cust_id,
    //             'bill_amount' => $bill->bill_amount,
    //             'settle_mode' => 1,
    //             'status_flag' => 1,
    //             'card_number' => $request->input('card_number'),
    //             'bank' => $request->input('bank'),
    //         ]);
    //     }
    //     $settlement->save();
    //      // $username = urlencode("DUMMY"); 
    //     //
    //     // $msg_token = urlencode("DUMMY"); 
    //     // $sender_id = urlencode("TKBNGO"); // optional (compulsory in transactional sms) 
    //     // $message = urlencode("Message".$x."text will be provided"); 
    //     // $mobile = urlencode($request->input('cust_id')); 

    //     // $api = "http://managed.sms.techbongo.com/api/send_transactional_sms.php?username=".$username."&msg_token=".$msg_token."&sender_id=".$sender_id."&message=".$message."&mobile=".$mobile.""; 

    //     // $response = file_get_contents($api);
    //     return response()->json([
    //         'code' => 1,
    //     ]);
    // }
}
