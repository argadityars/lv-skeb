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
    return view('welcome');
});

# Public Pages
Route::get('books', 'PageController@books')->name('pages.books');

# Auth System
Auth::routes();
Route::get('register/verify/{token}', 'Auth\VerifyEmailController@verify');

# Dashboard
Route::get('/dashboard', 'PageController@index')->middleware('auth');

# Profile System
Route::resource('profile', 'ProfileController', ['except' => [
    'edit', 'update', 'show'
]]);
Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('profile/edit', 'ProfileController@update')->name('profile.update');
Route::get('/profile/edit/password', 'ProfileController@editPassword')->name('profile.password');
Route::post('/profile/edit/password', 'ProfileController@updatePassword')->name('profile.password');
Route::get('/profile/edit/customization', 'ProfileController@editCustomization')->name('profile.customization');
Route::post('/profile/edit/customization', 'ProfileController@updateCustomization')->name('profile.customization');

# Shop System
Route::resource('shop', 'ShopController', ['except' => [
    'edit', 'update', 'show'
]]);
Route::get('shop/edit', 'ShopController@edit')->name('shop.edit');
Route::post('shop/edit', 'ShopController@update')->name('shop.update');
Route::get('shop/edit/customization', 'ShopController@editCustomization')->name('shop.customization');
Route::post('shop/edit/customization', 'ShopController@updateCustomization')->name('shop.customization');

# Product System
Route::resource('product', 'ProductController', ['except' => [
    'edit', 'update', 'show', 'destroy'
]]);
Route::get('product/show/{slug}', 'ProductController@show')->name('product.show');
Route::get('product/edit/{slug}', 'ProductController@edit')->name('product.edit');
Route::post('product/edit/{slug}', 'ProductController@update')->name('product.update');
Route::delete('product/delete/{slug}', 'ProductController@destroy')->name('product.delete');
