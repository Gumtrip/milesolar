<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Article\Article;
use App\Jobs\Traits\DelAndCleanDir;
class DeleteAndCleanDir
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,DelAndCleanDir;

    protected $path;
    /** 清空文件所在的文件夹并且删除文件夹
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $path = $article->image;
        if(!$path||$path=='/')return;
        $this->path = public_path($path);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->DelDirHandle($this->path);

    }
}
