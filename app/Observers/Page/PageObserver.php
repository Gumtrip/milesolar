<?php

namespace App\Observers\Page;

use App\Jobs\Page\MoveImageFrTx;
use App\Jobs\ImageHandle\CompressImg;
use App\Models\Page\Page;
use App\Services\ImageHandleService;

class PageObserver
{
    CONST FOLDER = 'page';

    /**
     * Handle the page "created" event.
     *
     * @param \App\Models\Page\Page $page
     * @return void
     */
    public function created(Page $page)
    {
        MoveImageFrTx::dispatch($page);//将富文本的图片移动到正确的位置
        $uploadImageService = app(ImageHandleService::class);
        if ($images = $page->images) {
            foreach ($images as $image) {
                $path = $uploadImageService->moveFile($image, self::FOLDER, $page->id);
                $image->update(['path' => $path]);
                CompressImg::dispatch($image->path);//压缩图片
            }
        }
    }

    /**
     * Handle the page "updated" event.
     *
     * @param \App\Models\Page\Page $page
     * @return void
     */
    public function updated(Page $page)
    {
        //
    }

    /**
     * Handle the page "deleted" event.
     *
     * @param \App\Models\Page\Page $page
     * @return void
     */
    public function deleted(Page $page)
    {
        $images = $page->images;
        foreach ($images as $image) {
            $image->delete();
        }
    }

    /**
     * Handle the page "restored" event.
     *
     * @param \App\Models\Page\Page $page
     * @return void
     */
    public function restored(Page $page)
    {
        //
    }

    /**
     * Handle the page "force deleted" event.
     *
     * @param \App\Models\Page\Page $page
     * @return void
     */
    public function forceDeleted(Page $page)
    {
        //
    }
}
