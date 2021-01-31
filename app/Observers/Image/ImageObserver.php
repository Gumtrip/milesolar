<?php

namespace App\Observers\Image;

use App\Jobs\ImageHandle\CompressImg;
use App\Jobs\ImageHandle\DeleteImages;
use App\Models\Image\Image;
use App\Services\ImageHandleService;

class ImageObserver
{

    /**
     * Handle the page image "created" event.
     *
     * @param \App\Models\Image\Image $Image
     * @return void
     */
    public function created(Image $Image)
    {
        CompressImg::dispatch($Image->path);//压缩图片
    }

    /**
     * Handle the page image "updated" event.
     *
     * @param \App\Models\Image\Image $Image
     * @return void
     */
    public function updated(Image $Image)
    {
        //
    }

    /**
     * Handle the page image "deleted" event.
     *
     * @param \App\Models\Image\Image $Image
     * @return void
     */
    public function deleted(Image $Image)
    {
        DeleteImages::dispatch($Image->path);
    }

    /**
     * Handle the page image "restored" event.
     *
     * @param \App\Models\Image\Image $Image
     * @return void
     */
    public function restored(Image $Image)
    {
        //
    }

    /**
     * Handle the page image "force deleted" event.
     *
     * @param \App\Models\Image\Image $Image
     * @return void
     */
    public function forceDeleted(Image $Image)
    {
        //
    }
}
