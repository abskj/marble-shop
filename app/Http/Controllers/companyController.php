<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;


class companyController extends Controller
{
    //
    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required'
        ]);
        $comp = new company([
            'name' => $request->input('name')
        ]);
        $comp->save();
        return response()->json([
            'code' => 1,
            'text' => 'Company added successfully'
        ]);
    }

    public function delete(Request $request){
        $this->validate($request, [
            'id' => 'required'
        ]);
        $comp = company::find($request->input('id'));
        $comp-> delete();
        return response()->json([
            'code' => 1,
            'text' => 'Company deleted successfully'
        ]);
    }

    public function fetch(Request $request){
        $company_data = company::all();
        return response()->json([
            'companies' => $company_data
        ]);
    }
}
