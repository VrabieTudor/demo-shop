<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/products/{product}', 'ProductController@edit')->name('products.edit');
    Route::put('/products/{product}', 'ProductController@update')->name('products.update');
    Route::get('/products-create', 'ProductController@create')->name('products.create');
    Route::post('/products', 'ProductController@store')->name('products.store');
    Route::delete('/products/{product}', 'ProductController@destroy')->name('products.delete');
});
Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/cart/add-to-cart/{product}', 'CartController@store')->name('cart.store');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::get('/cart-remove/{item}', 'CartController@remove')->name('cart.remove');
Route::post('/cart/checkout', 'CartController@checkout')->name('cart.checkout');
Route::get('/', 'ProductController@index')->name('products.index');