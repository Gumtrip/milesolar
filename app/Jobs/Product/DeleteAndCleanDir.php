<?php

namespace App\Jobs\Product;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product\Product;
use App\Jobs\Traits\DelAndCleanDir;

class DeleteAndCleanDir
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,DelAndCleanDir;
    protected $path;
    CONST FOLDER = 'product';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $filesRoot = config('filesystems.disks.public.root') ;
        $dir = self::FOLDER . '/' . $product->id;
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
