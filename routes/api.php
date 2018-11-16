<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * User API
 */
Route::post('/user/login',[
    'uses'=> 'userController@login'
]);
Route::post('/user/create',[
    'uses'=> 'userController@create'
]);

/**
 * Company API
 */
Route::post('/company',[
    'uses' => 'companyController@create'
]);

Route::get('/company',[
    'uses' => 'companyController@fetch'
]);

Route::delete('/company',[
    'uses' => 'companyController@delete'
]);
/**
 * Category API
 */
Route::post('/category',[
    'uses' => 'categoryController@create'
]);

Route::get('/category',[
    'uses' => 'categoryController@fetch'
]);

Route::delete('/category',[
    'uses' => 'categoryController@delete'
]);
 