<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use File;
class DeleteImages
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $image;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($image)
    {
        $this->image = public_path($image);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->deleteHandle($this->image);
        $imageSizes = config('app.thumb_img');
        foreach($imageSizes as $size=>$thumb) {
            $this->deleteHandle(getThumbName($this->image,$thumb['name']));
        }

    }
    private function deleteHandle($image){//这里不用Storage::disk(self::DISKS)->exists($image)判断
        if(File::exists($image)){//因为Storage::disk(self::DISKS)会在路径前面加storage
            File::delete($image);//数据库的值是带storage
        }
    }
}
