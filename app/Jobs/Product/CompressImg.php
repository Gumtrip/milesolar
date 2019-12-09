<?php

namespace App\Jobs\Product;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\Traits\CompressImages;
use App\Models\Product\ProductImage;
class CompressImg
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,CompressImages;
    protected $path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ProductImage $image)
    {
        $this->path = $image->path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->compressHandle($this->path);
    }
}
