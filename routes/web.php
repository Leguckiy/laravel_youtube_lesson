<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\MainController@index')->name('index');
Route::get('/categories', 'App\Http\Controllers\MainController@categories')->name('categories');
Route::get('/{category}/{product?}', 'App\Http\Controllers\MainController@product')->name('product');
Route::get('/basket', 'App\Http\Controllers\BasketController@basket')->name('basket');
Route::get('/basket/place', 'App\Http\Controllers\BasketController@basketPlace')->name('basket-place');
Route::get('/{category}', 'App\Http\Controllers\MainController@category')->name('category');
Route::post('/basket/add/{id}', 'App\Http\Controllers\BasketController@basketAdd')->name('basket-add');
