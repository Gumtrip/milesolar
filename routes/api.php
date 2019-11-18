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
            Route::resource('products', 'ProductController')->only(['index', 'show']);
        });

        Route::group(['namespace' => 'Auth', 'prefix' => 'auth'],
            function ($api) {
                $api->post('login', 'LoginController@login');
                $api->delete('logout', 'LoginController@logout');
            });
    });


});
