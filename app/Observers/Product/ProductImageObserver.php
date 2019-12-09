<?php

namespace App\Observers\Product;

use App\Jobs\Product\DeleteImages;
use App\Jobs\Product\CompressImg;
use App\Models\Product\ProductImage;

class ProductImageObserver
{

    /**
     * Handle the product image "created" event.
     *
     * @param  \App\Models\Product\ProductImage  $productImage
     * @return void
     */
    public function created(ProductImage $productImage)
    {
        CompressImg::dispatch($productImage);//压缩图片
    }

    /**
     * Handle the product image "updated" event.
     *
     * @param  \App\Models\Product\ProductImage  $productImage
     * @return void
     */
    public function updated(ProductImage $productImage)
    {
        if($productImage->isDirty('path')){
            CompressImg::dispatch($productImage);//压缩图片
        }
    }

    /**
     * Handle the product image "deleted" event.
     *
     * @param  \App\Models\Product\ProductImage  $productImage
     * @return void
     */
    public function deleted(ProductImage $productImage)
    {
        DeleteImages::dispatch($productImage);
    }

    /**
     * Handle the product image "restored" event.
     *
     * @param  \App\Models\Product\ProductImage  $productImage
     * @return void
     */
    public function restored(ProductImage $productImage)
    {
        //
    }

    /**
     * Handle the product image "force deleted" event.
     *
     * @param  \App\Models\Product\ProductImage  $productImage
     * @return void
     */
    public function forceDeleted(ProductImage $productImage)
    {
        //
    }
}
