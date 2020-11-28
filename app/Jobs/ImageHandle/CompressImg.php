<?php

namespace App\Jobs\ImageHandle;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use File;
use Image;

class CompressImg
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $path;

    /**
     * Create a new job instance.
     * @param $image
     * @return void
     */
    public function __construct($image)
    {
        $this->path = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $path = $this->path;
        $imageSizes = config('app.thumb_img');
        foreach ($imageSizes as $size => $thumb) {
            $maxWidth = $thumb['size'];
            $thumbName = getThumbName($path, $thumb['name']);
            if (File::exists(public_path($thumbName))) {
                continue;
            }
            // 先实例化，传参是文件的磁盘物理路径
            $image = Image::make(public_path($path));//用绝对路径
            // 进行大小调整的操作
            $image->resize($maxWidth, null, function ($constraint) {
                // 设定宽度是 $max_width，高度等比例双方缩放
                $constraint->aspectRatio();
                // 防止裁图时图片尺寸变大
                $constraint->upsize();
            });
            //这个文件夹是快捷方式的话，无法写入
            //任务无法写入，请使用sudo php artisan horizon
            $image->save(public_path($thumbName));
            File::chmod(public_path($thumbName), 0755);
        }
    }
}
