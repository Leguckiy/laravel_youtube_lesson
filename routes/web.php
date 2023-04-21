<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\MainController@index');
Route::get('/categories', 'App\Http\Controllers\MainController@categories');
Route::get('/{category}', 'App\Http\Controllers\MainController@category');
Route::get('/mobiles/{product?}', 'App\Http\Controllers\MainController@product');
