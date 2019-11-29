<?php

namespace App\Jobs;

use File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteAndCleanDir implements ShouldQueue
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
        $this->path = public_path($path);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dir= (File::dirname($this->path));
        if(File::isDirectory($dir)){
            File::cleanDirectory($dir);
            File::deleteDirectory($dir);
        }
    }
}
