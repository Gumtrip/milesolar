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
//    'middleware' => 'throttle:' . config('api.rate_limits.access')
], function () {
    // 后端
    Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin'
    ], function () {
        //产品
        Route::group(['namespace' => 'Product'], function () {
            Route::resource('products', 'ProductController')->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('product_categories', 'ProductCategoryController')->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::get('product_category_trees', 'ProductCategoryController@showTree');
        });
        //文章
        Route::group(['namespace' => 'Article'], function () {
            Route::resource('articles', 'ArticleController')->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('article_categories', 'ArticleCategoryController')->only(['index', 'store', 'show', 'update', 'destroy']);
        });
        //案例
        Route::group(['namespace' => 'Sample'], function () {
            Route::resource('samples', 'SampleController')->only(['index', 'store', 'show', 'update', 'destroy']);
            Route::resource('sample_categories', 'SampleCategoryController')->only(['index', 'store', 'show', 'update', 'destroy']);
        });
        //询盘
        Route::group(['namespace' => 'Message'], function () {
            Route::resource('messages', 'MessageController')->only(['index', 'show', 'destroy']);
        });
//后台管理员
        Route::group(['namespace' => 'Admin'], function () {
            Route::resource('admins', 'AdminController')->only(['show']);
            Route::post('admin/me', 'AdminController@me');
        });
        //上传图片接口
        Route::group(['namespace' => 'Image'], function () {
            Route::post('image', 'ImageController@store');
        });

        Route::group(['namespace' => 'Auth', 'prefix' => 'auth'],function () {
                Route::post('authorization', 'AuthorizationController@store');
                Route::put('authorization', 'AuthorizationController@update');
                Route::delete('authorization', 'AuthorizationController@destroy');
            });
        Route::group(['namespace' => 'Google', 'prefix' => 'google'],function () {
                Route::get('visitors-and-page-views', 'AnalyseController@visitorsAndPageViews');
                Route::get('total-visitors-and-page-views', 'AnalyseController@totalVisitorsAndPageViews');
                Route::get('most-visited-pages', 'AnalyseController@mostVisitedPages');
                Route::get('top-referrers', 'AnalyseController@topReferrers');
                Route::get('user-types', 'AnalyseController@userTypes');
                Route::get('top-browsers', 'AnalyseController@topBrowsers');
            });
    });
    //前端
    Route::group(['namespace'=>'Frontend'],function(){
        //产品
        Route::group(['namespace' => 'Product'], function () {
            Route::resource('products', 'ProductController')->only(['index', 'show']);
            Route::resource('product_categories', 'ProductCategoryController')->only(['index', 'show']);
            Route::get('product_category_trees', 'ProductCategoryController@showTree');
        });
        //文章
        Route::group(['namespace' => 'Article'], function () {
            Route::resource('articles', 'ArticleController')->only(['index', 'show']);
        });
        //案例
        Route::group(['namespace' => 'Sample'], function () {
            Route::resource('samples', 'SampleController')->only(['index', 'show']);
        });
        //询盘
        Route::group(['namespace' => 'Message'], function () {
            Route::resource('messages', 'MessageController')->only(['store']);
        });
    });
});
