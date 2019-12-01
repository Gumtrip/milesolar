<?php

namespace App\Jobs;

use File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
class DeleteAndCleanDir
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;
    /** 清空文件所在的文件夹并且删除文件夹
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path)
    {
        if(!$path)return;
        $this->path = public_path($path);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dir= (File::dirname($this->path));//这里有bug！！！，如果传的值是空，那么public 就会是项目的跟目录，
        if(File::isDirectory($dir)&&File::exists($this->path)){//使用队列的时候，它的根目录变成了项目的根目录了
            File::cleanDirectory($dir);//使用sudo php artisan horizon 的话，就会删除整个项目目录
            File::deleteDirectory($dir);//所以必须检测文件是否存在，不然会清空项目文件夹
        }else{
            Log::warning('【'.$this->path.'】文件不存在或文件夹不存在');
        }
    }
}
