<?php

namespace App\Jobs\Sample;

use App\Jobs\Traits\CompressImages;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Sample\Sample;
class CompressImg
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,CompressImages;
    protected $path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sample $sample)
    {
        $this->path = $sample->image;
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
