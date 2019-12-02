<?php

namespace App\Jobs\Article;

use App\Models\Article\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\Traits\MoveImagesFromTextArea;
use DB;
class MoveImageFrTx
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,MoveImagesFromTextArea;
    protected $article;
    const FOLDER = 'article';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = $this->article->desc;
        $matches = $this->matchImages($content);
        if(isset($matches[1])&&$matches[1]){
            foreach($matches[1] as $image){
                $path = $this->moveImage($image,self::FOLDER,$this->article->id);
                //这里很笨，直接遍历整个content 然后替换掉image
                //图片多后者富文本内容多，会有效率问题
                //TODO 找更好的方法一次替换，而不是通过遍历替换
                $content = str_replace($image,asset($path),$content);
            }
            DB::table('articles')->where('id',$this->article->id)->update(['desc'=>$content]);
        }else{//没有图片，直接返回
            return;
        }
    }
}