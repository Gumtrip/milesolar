<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
use App\Observers\Article\ArticleObserver;
use App\Models\Article\Article;
use App\Observers\Product\ProductObserver;
use App\Models\Product\Product;
use App\Observers\Product\ProductImageObserver;
use App\Models\Product\ProductImage;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Article::observe(ArticleObserver::class);
        ProductImage::observe(ProductImageObserver::class);
        Product::observe(ProductObserver::class);
        Resource::withoutWrapping();
    }
}
