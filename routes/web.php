<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('get-logout');

Route::group([
    'middleware' => 'auth',
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => 'admin',
], function() {
    Route::group(['middleware' => 'is_admin'], function() {
        Route::get('/orders', 'OrderController@index')->name('home');
        Route::resource('categories', 'CategoryController');
    });
});

Route::get('/', 'App\Http\Controllers\MainController@index')->name('index');
Route::get('/categories', 'App\Http\Controllers\MainController@categories')->name('categories');

Route::group(['prefix' => 'basket'], function() {
    Route::post('/add/{id}', 'App\Http\Controllers\BasketController@basketAdd')->name('basket-add');
    Route::group(['middleware' => 'basket_not_empty'], function() {
        Route::get('/', 'App\Http\Controllers\BasketController@basket')->name('basket');
        Route::get('/place', 'App\Http\Controllers\BasketController@basketPlace')->name('basket-place');
        Route::post('/remove/{id}', 'App\Http\Controllers\BasketController@basketRemove')->name('basket-remove');
        Route::post('/confirm', 'App\Http\Controllers\BasketController@basketConfirm')->name('basket-confirm');
    });
});

Route::get('/{category}/{product}', 'App\Http\Controllers\MainController@product')->name('product');
Route::get('/{category}', 'App\Http\Controllers\MainController@category')->name('category');
