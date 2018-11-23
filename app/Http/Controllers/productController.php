<?php

namespace App\Http\Controllers;
use App\product;
use App\company;
use App\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use \Validator;
use Intervention\Image\ImageManagerStatic as Image;
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
            'img_url' => "blank",
        ]);
        $item->save();
        return response()->json([
            "code" => 1,
            "product_id" => $item->id,
        ]);

    }

    public function image(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image64:jpeg,jpg,png'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        } else {
            $imageData = $request->get('image');
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path().$fileName);
            return response()->json(['error'=>false]);
        
    }
}
    public function get(Request $request){
       
        $items = product::all();
        foreach($items as $item){
            
            $item->category=  Category::where('id',$item->type)->first();
            $item->company=  company::where('id',$item->company)->first();
        }
        return response()->json([
            "code" => 1,
            "products" => $items,
        ]);
    }
}