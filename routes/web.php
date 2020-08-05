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
Route::group(['namespace'=>'Frontend'],function(){
    Route::get('/', 'IndexController@index')->name('index');
    //产品
    Route::group(['namespace'=>'Product','prefix'=>'products'],function(){
        Route::get('/', 'ProductController@index')->name('products');
        Route::get('/{product}/{slug?}', 'ProductController@show')->name('products.show')->where('product', '[0-9]+');
        Route::get('product-categories/{productCategory}/{slug?}', 'ProductCategoryController@index')->name('productCategories');
    });
    //案例
    Route::group(['namespace'=>'Sample','prefix'=>'samples'],function(){
        Route::get('/', 'SampleController@index')->name('samples');
        Route::get('/{sample}/{slug?}', 'SampleController@show')->name('samples.show');
    });
    //文章
    Route::group(['namespace'=>'Article','prefix'=>'articles'],function(){
        Route::get('/', 'ArticleController@index')->name('articles');
        Route::get('/{article}/{slug?}', 'ArticleController@show')->name('articles.show');
    });
    //联系我们
    Route::group(['namespace'=>'Contact','prefix'=>'contact'],function(){
        Route::get('/{product?}/{slug?}', 'ContactController@index')->name('contact');
        Route::post('/', 'ContactController@store')->name('contact.store');
    });

});


Route::get('sitemap', 'SitemapController@index');
Route::view('/admin','backend.index');
