<?php

namespace App\Jobs\ImageHandle;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product\Product;
use File;
use Illuminate\Support\Facades\Log;

class DeleteAndCleanDir
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $path;
    const FOLDER = 'product';

    /**
     *
     * Create a new job instance.
     * @param $model //模型 一般跟model 名称一样，小写
     * @param $id
     * @return void
     */
    public function __construct($model, $id)
    {
        $filesRoot = config('filesystems.disks.public.root');
        $dir = $model . '/' . $id;
        $this->path = $filesRoot . '/' . $dir;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 正确的逻辑应该是检测文件夹里面的文件，遍历删除，（只删除图片~）
        // 如果是空，则删除整个文件夹 ，不是空就写入日志
        $dir = $this->path;
        if (File::isDirectory($dir)) {//使用队列的时候，它的根目录变成了项目的根目录了
            File::cleanDirectory($dir);//使用sudo php artisan horizon 的话，就会删除整个项目目录
            File::deleteDirectory($dir);//所以必须检测文件是否存在，不然会清空项目文件夹
        } else {
            Log::channel('delete_error')->info('【' . $dir . '】文件不存在或文件夹不存在');
        }
    }
}
