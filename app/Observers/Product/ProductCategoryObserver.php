<?php

namespace App\Observers\Product;

use App\Jobs\ImageHandle\CompressImg;
use App\Jobs\ImageHandle\DeleteImages;
use App\Models\Product\ProductCategory;
use App\Services\ImageHandleService;
use DB;

class ProductCategoryObserver
{
    CONST FOLDER = 'product_category';

    /**
     * Handle the product category "created" event.
     *
     * @param  \App\Models\Product\ProductCategory  $productCategory
     * @return void
     */
    public function created(ProductCategory $productCategory)
    {
        $uploadImageService = app (ImageHandleService::class);
        if($image = $productCategory->image) {
            $path = $uploadImageService->moveFile($image, self::FOLDER, $productCategory->id);
            $productCategory->image = $path;
            CompressImg::dispatch($productCategory->image);//压缩图片
            DB::table('product_categories')->where('id', $productCategory->id)->update(['image' => $path]);

        }
    }

    /**
     * Handle the product category "updated" event.
     *
     * @param  \App\Models\Product\ProductCategory  $productCategory
     * @return void
     */
    public function updated(ProductCategory $productCategory)
    {
        if($productCategory->isDirty('image')){
            //压缩新图
            CompressImg::dispatch($productCategory->image);
            //删除旧图
            DeleteImages::dispatch($productCategory->getOriginal('image'));
        }
    }

    /**
     * Handle the product category "deleted" event.
     *
     * @param  \App\Models\Product\ProductCategory  $productCategory
     * @return void
     */
    public function deleted(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Handle the product category "restored" event.
     *
     * @param  \App\Models\Product\ProductCategory  $productCategory
     * @return void
     */
    public function restored(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Handle the product category "force deleted" event.
     *
     * @param  \App\Models\Product\ProductCategory  $productCategory
     * @return void
     */
    public function forceDeleted(ProductCategory $productCategory)
    {
        //
    }
}
