<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
use App\Models\Product\ProductCategory;
use App\Observers\Product\ProductCategoryObserver;
use App\Observers\Article\ArticleObserver;
use App\Models\Article\Article;
use App\Observers\Product\ProductObserver;
use App\Models\Product\Product;
use App\Observers\Product\ProductImageObserver;
use App\Models\Product\ProductImage;
use App\Observers\Sample\SampleObserver;
use App\Models\Sample\Sample;
use App\Observers\Page\PageObserver;
use App\Models\Page\Page;
use App\Observers\Image\ImageObserver;
use App\Models\Image\Image;

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
        ProductCategory::observe(ProductCategoryObserver::class);
        Sample::observe(SampleObserver::class);
        Page::observe(PageObserver::class);
        Image::observe(ImageObserver::class);

        Resource::withoutWrapping();
    }
}
