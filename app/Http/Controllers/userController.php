<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\user;
class userController extends Controller
{
    //
    public function login(Request $request){
        $this->validate($request, [
            'user_name' => 'required',
            'password' => 'required'
            ]);
        $credentials = $request->only('user_name','password');
        try{
            if(!$token=JWTAuth::attempt($credentials)){
                return \response()->json([
                    'error' => 'Invalid Credentials'
                ],401);
            }
        }catch (JWTException $e){
            return response('Server Error',500);
        }
        $user= user::where('user_name',$request->input('user_name'))->get()->first();
        return \response()->json([
            'message'=>'success',
            'token'=>$token,
            'status'=>$user->status,
            'first_name'=>$user->first_name,
            'last_name' => $user->last_name,
            'type' => $user->type,

        ],201);


    }
    public function create(Request $request){
        $this->validate($request,[
            'user_name' => 'required|unique:users',
            'password' => 'required',
            'first_name' => 'required',
            'last_name' => 'last_name',
            'type' => 'required'
        ]);

        $user = new user([
            'user_name' => $request->input('user_name'),
            'password' => bcrypt($request->input('password')),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'type' => $request->input('type'),
        ]);
        $user->save();
        return response()->json([
            'code' => 1,
            'text' => 'User created successfully'
        ]);
    }
}
