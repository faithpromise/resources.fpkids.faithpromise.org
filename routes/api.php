<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'jwt.auth'], function () {

    Route::get('/products', 'ProductsController@index');
    Route::get('/products/{id}', 'ProductsController@show');
    Route::get('/orders', 'OrdersController@index');
    Route::get('/orders/{id}', 'OrdersController@show');
    Route::post('/orders', 'OrdersController@store');

});

Route::post('/login', 'JWTAuthController@login');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
