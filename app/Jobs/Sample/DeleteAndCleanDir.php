<?php

namespace App\Jobs\Sample;

use App\Jobs\Traits\DelAndCleanDir;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Sample\Sample;

class DeleteAndCleanDir
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,DelAndCleanDir;
    protected $path;
    CONST FOLDER = 'sample';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sample $sample)
    {
        $filesRoot = config('filesystems.disks.public.root') ;
        $dir = self::FOLDER . '/' . $sample->id;
        $this->path = $filesRoot.'/'.$dir;
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
