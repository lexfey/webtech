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
Route::get('/cart', function () {
    return view('cart');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/register2', function () {
    return view('register2');
});
Route::get('/shop', function () {
    return view('shop');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/profile', function () {
    return view('profile');
});
/*
Route::post('/login/signin', 'UserController@signin');
Route::post('/register/submit', 'UserController@submit');
*/
Route::post('/contact/submit', 'MessageController@submit'); 

Route::resource('test', 'TestController'); 
Route::resource('shop', 'ProductController'); 
Route::resource('user', 'UserController'); 
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
