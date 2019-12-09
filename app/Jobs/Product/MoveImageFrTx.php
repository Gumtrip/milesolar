<?php

namespace App\Jobs\Product;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\Traits\MoveImagesFromTextArea;
use App\Models\Product\Product;
use DB;

class MoveImageFrTx
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,MoveImagesFromTextArea;
    protected $product;
    const FOLDER = 'product';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = $this->product->desc_0;
        $matches = $this->matchImages($content);
        if(isset($matches[1])&&$matches[1]){
            foreach($matches[1] as $image){
                $path = $this->moveImage($image,self::FOLDER,$this->product->id);
                //这里很笨，直接遍历整个content 然后替换掉image
                //图片多后者富文本内容多，会有效率问题
                //TODO 找更好的方法一次替换，而不是通过遍历替换
                if($path){//如果图片存在，则移动，因为有可以能图片是第三方的！
                    $content = str_replace($image,asset($path),$content);
                }
            }
            DB::table('products')->where('id',$this->product->id)->update(['desc_0'=>$content]);
        }else{//没有图片，直接返回
            return;
        }

    }
}
