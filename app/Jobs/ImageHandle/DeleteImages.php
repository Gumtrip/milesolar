<?php

namespace App\Jobs\ImageHandle;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product\ProductImage;
use File;

class DeleteImages
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $image;

    /**
     * Create a new job instance.
     * @param ProductImage $image
     * @return void
     */
    public function __construct($image)
    {
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $imageSizes = config('app.thumb_img');
        $this->deleteHandle($this->image);//删除原图
        foreach ($imageSizes as $size => $thumb) {//删除压缩图
            $this->deleteHandle(getThumbName($this->image, $thumb['name']));
        }
    }

    function deleteHandle($image)
    {
//这里不用Storage::disk(self::DISKS)->exists($image)判断
        $image = public_path($image);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        if (File::exists($image) && in_array($ext, ['jpg', 'jpeg', 'gif', 'png'])) {//因为Storage::disk(self::DISKS)会在路径前面加storage
            File::delete($image);//数据库的值是带storage
        }
    }
}
