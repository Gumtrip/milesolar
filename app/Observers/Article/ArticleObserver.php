<?php

namespace App\Observers\Article;

use App\Jobs\CompressImages;
use App\Models\Article\Article;
use App\Services\UploadImageService;
use DB;
class ArticleObserver
{
    CONST FOLDER='article';

    /**
     * Handle the article "created" event.
     *
     * @param  \App\Models\Article\Article  $article
     * @return void
     */
    public function created(Article $article)
    {
        $uploadImageService = app (UploadImageService::class);
        $paths = $uploadImageService->moveAndCompress($article->image,self::FOLDER,$article->id);
        DB::table('articles')->where('id',$article->id)->update(['image'=>$paths[0]]);
    }

    /**
     * Handle the article "updated" event.
     *
     * @param  \App\Models\Article\Article  $article
     * @return void
     */
    public function updated(Article $article)
    {
        if($article->isDirty('image')){
            CompressImages::dispatch($article->image);
            //删除旧图
        }

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
