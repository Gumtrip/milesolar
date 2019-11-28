<?php

namespace App\Observers;

use App\Models\Article\Article;
use App\Services\UploadImageService;

class ArticleObserver
{
    CONST FOLDER='article';

    /**
     * Handle the article "created" event.
     *
     * @param  \App\Models\Article\Article  $article
     * @return void
     */
    public function created(Article $article,UploadImageService $uploadImageService)
    {
        if($image = $article->image){
            $paths = $uploadImageService->moveAndCrop($image,self::FOLDER,$article->id);
            $article->update(['image'=>$paths[0]]);
        }
    }

    /**
     * Handle the article "updated" event.
     *
     * @param  \App\Models\Article\Article  $article
     * @return void
     */
    public function updated(Article $article)
    {
        //
    }

    /**
     * Handle the article "deleted" event.
     *
     * @param  \App\Models\Article\Article  $article
     * @return void
     */
    public function deleted(Article $article)
    {
        //
    }

    /**
     * Handle the article "restored" event.
     *
     * @param  \App\Models\Article\Article  $article
     * @return void
     */
    public function restored(Article $article)
    {
        //
    }

    /**
     * Handle the article "force deleted" event.
     *
     * @param  \App\Models\Article\Article  $article
     * @return void
     */
    public function forceDeleted(Article $article)
    {
        //
    }
}
