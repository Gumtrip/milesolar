<?php

namespace App\Jobs\ImageHandle;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product\Product;
use App\Jobs\Traits\DelAndCleanDir;
use File;

class DeleteAndCleanDir
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $path;
    const FOLDER = 'product';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $filesRoot = config('filesystems.disks.public.root');
        $dir = self::FOLDER . '/' . $product->id;
        $this->path = $filesRoot . '/' . $dir;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dir = $this->path;
        if (File::isDirectory($dir)) {//使用队列的时候，它的根目录变成了项目的根目录了
            File::cleanDirectory($dir);//使用sudo php artisan horizon 的话，就会删除整个项目目录
            File::deleteDirectory($dir);//所以必须检测文件是否存在，不然会清空项目文件夹
        } else {
            Log::warning('【' . $dir . '】文件不存在或文件夹不存在');
        }
    }
}
