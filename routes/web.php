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
    return view('about');
});
Route::get('/about', function () {
    return view('about');
});

Auth::routes();
Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
Route::resource('/shop', 'ProductController');
Route::resource('/cart', 'CartController');
Route::resource('/user', 'UserController');
Route::get('/dashboard', 'DashboardController@index');


Route::post('check', 'ProductController@postCheckout')->name('check');
Route::post('pay', 'ProductController@finalCheckout')->name('pay');
Route::get('/checkout', [
    'uses' => 'ProductController@getCheckout',
    'as' => 'checkout',
    'middleware' => 'auth'   //to protect from not logged in users accessing it
]);


Route::get('/account', [
    'uses' => 'UserController@account',
    'as' => 'account']);
Route::get('/orders', [
    'uses' => 'UserController@getOrders',
    'as' => 'orders',
    'middleware' => 'auth']);

Route::get('/changepassword', [
    'uses' => 'UserController@showChangePasswordForm',
    'as' => 'changepassword']);
Route::get('/deleteaccount', [
    'uses' => 'UserController@showDeleteAccountForm',
    'as' => 'deleteaccount']);

Route::post('/changepassword', 'UserController@changePassword')->name('changepassword');
Route::post('/deleteaccount', 'UserController@destroy')->name('deleteaccount');

Route::get('/changeOrder/{id}', 'UserController@changeOrder');

Route::get('/shop/addToCart/{id}', 'ProductController@getAddToCart');
Route::get('/deleteFromCart/{id}', 'ProductController@getDeleteFromCart');
//Route::get('/removeOneFromCart/{id}', 'ProductController@getRemoveOneFromCart');
//Route::get('/addOneToCart/{id}', 'ProductController@getAddOneToCart');

Route::get('/shoppingCart', [
    'uses' => 'ProductController@getCart',
    'as' => 'product.shoppingCart']);