<?php

namespace App\Observers\Product;

use App\Jobs\Product\DeleteAndCleanDir;
use App\Jobs\Product\MoveImageFrTx;
use App\Models\Product\Product;

class ProductObserver
{

    /**
     * Handle the product "created" event.
     *
     * @param  \App\Models\Product\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Models\Product\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Models\Product\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $images = $product->images;
        foreach ($images as $image) {
            $image->delete();
        }
        //DeleteAndCleanDir::dispatch($product);
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \App\Models\Product\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \App\Models\Product\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
