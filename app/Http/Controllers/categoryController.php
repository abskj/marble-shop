<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    //
    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required'
        ]);
        $comp = new Category([
            'name' => $request->input('name')
        ]);
        $comp->save();
        return response()->json([
            'code' => 1,
            'text' => 'Category added successfully'
        ]);
    }

    public function delete(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);
        $comp = Category::find($request->input('id'));
        $comp-> delete();
        return response()->json([
            'code' => 1,
            'text' => 'Category deleted successfully'
        ]);
    }

    public function fetch(Request $request){
        $Category_data = Category::all();
        return response()->json([
            'categories' => $Category_data
        ]);
    }
}
