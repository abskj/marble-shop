<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Settlement;

class settlementController extends Controller
{
    //
    public function settle(Request $request){
        $this->validate($request,[
            'tran_id' => 'required',
            'settle_mode' => 'required',
            'amount_paid' => 'required',
            ]);
            $settlement = null;
            $tid = $request->input('tran_id');
            $paid =$request->input('amount_paid');
            $bill = DB::table('bills')->where('id', $tid)->first();
            $total =$bill->final;
            $due = $total - $paid;

            $cust = DB::table('customers')->where('id', $bill->cust_id)->first();
            if ($request->input('settle_mode') == 0) {
                //assuming 1 for card and 0 for cash
                $settlement = new settlement([
                    'bill_id' => $bill->id,
                    'paid' => $paid,
                    'due' => $due,
                    'settle_mode' => 0,
                    'status_flag' => 0,
                ]);
    
            } else {
                //assuming 1 for card and 0 for cash
                $settlement = new settlement([
                    'bill_id' => $bill->id,
                    'paid' => $paid,
                    'due' => $due,
                    'settle_mode' => 1,
                    'status_flag' => 0,
                    'card_number' => $request->input('card_number'),
                    'bank' => $request->input('bank'),
                ]);
            }
            $settlement->save();
            return response()->json([
                'code' => 1,
                'message' => 'transaction settled'
            ]);
    }
    public function generatePdf(Request $request){

    }
}
