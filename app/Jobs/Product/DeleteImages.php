<?php

namespace App\Jobs\Product;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product\ProductImage;
use App\Jobs\Traits\DelImages;

class DeleteImages
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,DelImages;
    protected $path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ProductImage $image)
    {
        $image = $image->getOriginal('path');
        $this->image = public_path($image);
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
        foreach($imageSizes as $size=>$thumb) {//删除压缩图
            $this->deleteHandle(getThumbName($this->image,$thumb['name']));
        }
    }
}
