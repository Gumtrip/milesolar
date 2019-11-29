<?php

namespace App\Observers\Article;

use App\Jobs\CompressImages;
use App\Jobs\DeleteImages;
use App\Models\Article\Article;
use App\Services\ImageHandleService;
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
        $uploadImageService = app (ImageHandleService::class);
        $path = $uploadImageService->moveFiles($article->image,self::FOLDER,$article->id);
        CompressImages::dispatch($path);
        DB::table('articles')->where('id',$article->id)->update(['image'=>$path]);
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
            //压缩新图
            CompressImages::dispatch($article->image);
            //删除旧图
            DeleteImages::dispatch($article->getOriginal('image'));
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
