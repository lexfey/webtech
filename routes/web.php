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


Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact/submit', 'MessageController@submit');


Auth::routes();
Route::resource('/shop', 'ProductController');
Route::resource('/cart', 'CartController');
Route::resource('/user', 'UserController');


Route::get('/dashboard', 'DashboardController@index');

Route::get('/checkout', [
    'uses'=>'ProductController@getCheckout',
    'as'=>'checkout']);

Route::get('/account', [
    'uses'=>'UserController@account',
    'as'=>'checkout']);

Route::post('/checkout', [
    'uses'=>'ProductController@postCheckout',
    'as'=>'checkout']);

Route::get('/shop/addToCart/{id}', 'ProductController@getAddToCart');
Route::get('/shoppingCart', [
    'uses'=>'ProductController@getCart',
    'as'=>'product.shoppingCart']);