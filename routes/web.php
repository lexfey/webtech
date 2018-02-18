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
Route::get('verifyEmailFirst','Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
Route::resource('/shop', 'ProductController');
Route::resource('/cart', 'CartController');
Route::resource('/user', 'UserController');



Route::get('/dashboard', 'DashboardController@index');

Route::get('/checkout', [
    'uses'=>'ProductController@getCheckout',
    'as'=>'checkout',
    'middleware'=>'auth'   //to protect from not logged in users accessing it
]);

Route::post('pay', 'ProductController@postCheckout')->name('pay');

Route::get('/account', [
    'uses'=>'UserController@account',
    'as'=>'account']);
Route::get('/orders', [
    'uses'=>'UserController@getOrders',
    'as'=>'orders']);
Route::get('/changepassword', [
    'uses'=>'UserController@showChangePasswordForm',
    'as'=>'changepassword']);

Route::post('/changepassword','UserController@changePassword')->name('changepassword');

Route::get('/deleteaccount', [
    'uses'=>'UserController@showDeleteAccountForm',
    'as'=>'deleteaccount']);

Route::post('/deleteaccount','UserController@destroy')->name('deleteaccount');


Route::get('/shop/addToCart/{id}', 'ProductController@getAddToCart');
Route::get('/deleteFromCart/{id}', 'ProductController@getDeleteFromCart');
Route::get('/removeOneFromCart/{id}', 'ProductController@getRemoveOneFromCart');
Route::get('/addOneToCart/{id}', 'ProductController@getAddOneToCart');

Route::get('/shoppingCart', [
    'uses'=>'ProductController@getCart',
    'as'=>'product.shoppingCart']);