<?php

namespace App\Observers\Page;

use App\Jobs\ImageHandle\CompressImg;
use App\Jobs\ImageHandle\DeleteImages;
use App\Models\Page\PageImage;
use App\Services\ImageHandleService;

class PageImageObserver
{
    CONST FOLDER = 'page';

    /**
     * Handle the page image "created" event.
     *
     * @param \App\Models\Page\PageImage $pageImage
     * @return void
     */
    public function created(PageImage $pageImage)
    {
        CompressImg::dispatch($pageImage->path);//压缩图片
    }

    /**
     * Handle the page image "updated" event.
     *
     * @param \App\Models\Page\PageImage $pageImage
     * @return void
     */
    public function updated(PageImage $pageImage)
    {
        //
    }

    /**
     * Handle the page image "deleted" event.
     *
     * @param \App\Models\Page\PageImage $pageImage
     * @return void
     */
    public function deleted(PageImage $pageImage)
    {
        DeleteImages::dispatch($pageImage->path);
    }

    /**
     * Handle the page image "restored" event.
     *
     * @param \App\Models\Page\PageImage $pageImage
     * @return void
     */
    public function restored(PageImage $pageImage)
    {
        //
    }

    /**
     * Handle the page image "force deleted" event.
     *
     * @param \App\Models\Page\PageImage $pageImage
     * @return void
     */
    public function forceDeleted(PageImage $pageImage)
    {
        //
    }
}
