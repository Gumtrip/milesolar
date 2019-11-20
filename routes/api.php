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

        Route::group(['namespace' => 'Auth', 'prefix' => 'auth'],
            function ($api) {
                $api->post('authorization', 'AuthorizationController@store');
                $api->put('authorization', 'AuthorizationController@update');
                $api->delete('authorization', 'AuthorizationController@destroy');
            });
    });


});
