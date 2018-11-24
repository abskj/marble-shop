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
 
/**
 * Product API
 */

 Route::post('/product/create', [
     'uses' => 'productController@create'
 ]);
 Route::post('/product/upload', [
    'uses' => 'productController@image'
]);
Route::post('/product/get', [
    'uses' => 'productController@get'
]);
Route::post('/product/fetch', [
    'uses' => 'productController@fetch'
]);
Route::get('product/images/{file}',
    'productController@getImage'
);
/**
 * Customer API
 * 
 */
Route::post('/customer/create',[
    'uses' => 'customerController@create'
]);
Route::post('/customer/get',[
    'uses' => 'customerController@get'
]);
/**
 * Billing API
 */
Route::post('/bill/initiate',[
    'uses' => 'billController@initiateTransaction'
]);
Route::post('/bill/part',[
    'uses' => 'billController@partTransaction'
]);
Route::post('/bill/get',[
    'uses' => 'billController@getPartTransactions'
]);
Route::post('/bill/reset',[
    'uses' => 'billController@reset'
]);
Route::post('/bill/remove',[
    'uses' => 'billController@removeItem'
]);
Route::post('/bill/complete',[
    'uses' => 'billController@complete'
]);
/**
 * Settlement API
 * 
 */
Route::post('/settlement/settle',[
    'uses' => 'settlementController@settle'
]);
Route::post('/settlement/generate',[
    'uses' => 'settlementController@generatePdf'
]);
