<?php

namespace App\Observers\Sample;

use App\Jobs\Sample\CompressImg;
use App\Jobs\Sample\DeleteAndCleanDir;
use App\Jobs\Sample\DeleteImages;
use App\Jobs\Sample\MoveImageFrTx;
use App\Models\Sample\Sample;
use App\Services\ImageHandleService;
use DB;

class SampleObserver
{
    CONST FOLDER='sample';
    /**
     * Handle the article "created" event.
     *
     * @param  \App\Models\Article\Article  $sample
     * @return void
     */
    public function created(Sample $sample)
    {
        $uploadImageService = app (ImageHandleService::class);
        if($image = $sample->image){
            $path = $uploadImageService->moveFile($image,self::FOLDER,$sample->id);
            $sample->image = $path;
            CompressImg::dispatch($sample);//压缩图片
            MoveImageFrTx::dispatch($sample);//将富文本的图片移动到正确的位置
            DB::table('samples')->where('id',$sample->id)->update(['image'=>$path]);
        }

    }

    /**
     * Handle the article "updated" event.
     *
     * @param  \App\Models\Article\Article  $sample
     * @return void
     */
    public function updated(Sample $sample)
    {
        if($sample->isDirty('image')){
            //压缩新图
            CompressImg::dispatch($sample);
            //删除旧图
            DeleteImages::dispatch($sample);
        }

    }

    /**
     * Handle the article "deleted" event.
     *
     * @param  \App\Models\Article\Article  $sample
     * @return void
     */
    public function deleted(Sample $sample)
    {
        DeleteAndCleanDir::dispatch($sample);
    }

}
