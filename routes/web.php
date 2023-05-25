<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::get('/locale/{locale}', 'App\Http\Controllers\MainController@changeLocale')->name('locale');
Route::get('/currency/{currencyCode}', 'App\Http\Controllers\MainController@changeCurrency')->name('currency');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('get-logout');

Route::middleware('set_locale')->group(function() {
    Route::get('/reset', 'App\Http\Controllers\ResetController@reset')->name('reset');
    Route::middleware('auth')->group(function() {
        Route::group([
            'namespace' => 'App\Http\Controllers\Person',
            'prefix' => 'person',
            'as' => 'person.',
        ], function() {
            Route::get('/orders', 'OrderController@index')->name('orders.index');
            Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
        });

        Route::group([
            'namespace' => 'App\Http\Controllers\Admin',
            'prefix' => 'admin',
        ], function() {
            Route::group(['middleware' => 'is_admin'], function() {
                Route::get('/orders', 'OrderController@index')->name('home');
                Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
            });

            Route::resource('categories', 'CategoryController');
            Route::resource('products', 'ProductController');
            Route::resource('products/{product}/skus', 'SkuController');
            Route::resource('properties', 'PropertyController');
            Route::resource('merchants', 'MerchantController');
            Route::get('merchants/{merchant}/update-token', 'MerchantController@updateToken')->name('merchants.update-token');
            Route::resource('coupons', 'CouponController');
            Route::resource('properties/{property}/property-options', 'PropertyOptionController');
        });
    });


    Route::get('/', 'App\Http\Controllers\MainController@index')->name('index');
    Route::get('/categories', 'App\Http\Controllers\MainController@categories')->name('categories');
    Route::post('/subscription/{sku}', 'App\Http\Controllers\MainController@subscribe')->name('subscription');

    Route::group(['prefix' => 'basket'], function() {
        Route::post('/add/{sku}', 'App\Http\Controllers\BasketController@basketAdd')->name('basket-add');
        Route::group(['middleware' => 'basket_not_empty'], function() {
            Route::get('/', 'App\Http\Controllers\BasketController@basket')->name('basket');
            Route::get('/place', 'App\Http\Controllers\BasketController@basketPlace')->name('basket-place');
            Route::post('/remove/{sku}', 'App\Http\Controllers\BasketController@basketRemove')->name('basket-remove');
            Route::post('/confirm', 'App\Http\Controllers\BasketController@basketConfirm')->name('basket-confirm');
            Route::post('coupon', 'App\Http\Controllers\BasketController@setCoupon')->name('set-coupon');
        });
    });

    Route::get('/{category}', 'App\Http\Controllers\MainController@category')->name('category');
    Route::get('/{category}/{product}/{sku}', 'App\Http\Controllers\MainController@sku')->name('sku');
});


