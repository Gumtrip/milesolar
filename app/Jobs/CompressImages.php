<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Article\Article;
use Storage;
use Image;
class CompressImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    CONST DISKS = 'public';
    protected $path;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $maxWidth = config('app.thumb_width');
        $thumbName = getThumbName($this->path);
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make(public_path($this->path));//用绝对路径
        // 进行大小调整的操作
        $image->resize($maxWidth, null, function ($constraint) {

            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });

        // 对图片修改后进行保存
        //这个文件夹新建的话，无法写入！
        //这个文件夹是快捷方式的话，无法写入
        //任务无法写入，请使用sudo php artisan horizon
        $image->save(public_path($thumbName));

    }
}
