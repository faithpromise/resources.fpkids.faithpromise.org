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

// TODO: Protect controller CUD methods with 'jwt.auth' middleware    Route::get('/products', 'ProductsController@index');

// Products
Route::get('/products', 'ProductsController@index');
Route::get('/products/{id}', 'ProductsController@show');
Route::post('/product-images', 'ProductImagesController@store');

// Orders
Route::get('/orders', 'OrdersController@index');
Route::get('/orders/{id}', 'OrdersController@show');
Route::post('/orders', 'OrdersController@store');

// Admin products
Route::post('/products', 'ProductsController@store');
Route::put('/products/{id}', 'ProductsController@update');
Route::delete('/products/{id}', 'ProductsController@destroy');
Route::get('/packaging', 'PackagingController@index');
Route::put('/order-items/{id}', 'PackagingController@update');

// Authentication
Route::post('/login', 'JWTAuthController@login');
Route::get('/login/refresh', 'JWTAuthController@refresh');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
