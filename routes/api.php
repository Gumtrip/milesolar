<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api',
    'middleware' => 'throttle:' . config('api.rate_limits.access')
], function () {
    Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin'
    ], function () {
        Route::group(['namespace' => 'Product'], function () {
            Route::resource('products', 'ProductController')->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('product_categories', 'ProductCategoryController')->only(['index', 'store', 'show', 'update', 'destroy']);
        });
        Route::group(['namespace' => 'Article'], function () {
            Route::resource('articles', 'ArticleController')->only(['index', 'store', 'show', 'update', 'destroy']);
        });
        Route::group(['namespace' => 'Message'], function () {
            Route::resource('messages', 'MessageController')->only(['index', 'show', 'destroy']);
        });

        Route::group(['namespace' => 'Admin'], function () {
            Route::resource('admins', 'AdminController')->only(['show']);
            Route::post('admin/me', 'AdminController@me');
        });
        Route::group(['namespace' => 'Image'], function () {
            Route::post('images', 'ImageController@store');
        });

        Route::group(['namespace' => 'Auth', 'prefix' => 'auth'],function () {
                Route::post('authorization', 'AuthorizationController@store');
                Route::put('authorization', 'AuthorizationController@update');
                Route::delete('authorization', 'AuthorizationController@destroy');
            });
    });
    Route::group(['namespace'=>'Frontend'],function(){
        Route::group(['namespace' => 'Product'], function () {
            Route::resource('products', 'ProductController')->only(['index', 'show']);
            Route::resource('product_categories', 'ProductCategoryController')->only(['index', 'show']);
        });
        Route::group(['namespace' => 'Article'], function () {
            Route::resource('articles', 'ArticleController')->only(['index', 'show']);
        });
        Route::group(['namespace' => 'Message'], function () {
            Route::resource('messages', 'MessageController')->only(['store']);
        });
    });

});
