<?php

namespace App\Http\Controllers;
use App\product;
use Illuminate\Http\Request;

class productController extends Controller
{
    //
    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'company' => 'required',
            'type' => 'required',
            'company' => 'required',
        ]);
        $item = new product([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'company' => $request->input('company'),
            'type' => $request->input('type'),
            'company' => $request->input('company'),
            'img_url' => "blank",
        ]);
        $item->save();

    }
}
