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
Route::get('/impressum', [ 'uses' => 'UserController@displayImpressum', 'as' => 'impressum',]);
Route::get('/sizetable', [ 'uses' => 'ProductController@displaySizetable', 'as' => 'sizetable',]);

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

Route::get('/cartcheck', [
    'uses' => 'UserController@checkForCart',
    'as' => 'cartcheck',
    'middleware' => 'auth']);

Route::get('/account', [
    'uses' => 'UserController@account',
    'as' => 'account',
    'middleware' => 'auth']);
Route::get('/orders', [
    'uses' => 'UserController@getOrders',
    'as' => 'orders',
    'middleware' => 'auth']);

Route::get('/changepassword', [
    'uses' => 'UserController@showChangePasswordForm',
    'as' => 'changepassword',
    'middleware' => 'auth']);
Route::get('/deleteaccount', [
    'uses' => 'UserController@showDeleteAccountForm',
    'as' => 'deleteaccount',
    'middleware' => 'auth']);

Route::post('/changepassword', 'UserController@changePassword')->name('changepassword');
Route::post('/deleteaccount', 'UserController@destroy')->name('deleteaccount');

//todo check if save
Route::get('/changeOrder/{id}', 'UserController@changeOrder');

Route::get('/shop/addToCart/{id}', 'ProductController@getAddToCart');
Route::get('/deleteFromCart/{id}', 'ProductController@getDeleteFromCart');
//Route::get('/removeOneFromCart/{id}', 'ProductController@getRemoveOneFromCart');
//Route::get('/addOneToCart/{id}', 'ProductController@getAddOneToCart');

Route::get('/shoppingCart', [
    'uses' => 'ProductController@getCart',
    'as' => 'product.shoppingCart']);