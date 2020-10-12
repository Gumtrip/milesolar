<?php

namespace App\Jobs\Sample;

use App\Jobs\Traits\DelImages;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Sample\Sample;
class DeleteImages
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,DelImages;
    protected $image;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sample $sample)
    {
        $this->image = $sample->getOriginal('image');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $imageSizes = config('app.thumb_img');
        $this->deleteHandle($this->image);
        foreach($imageSizes as $size=>$thumb) {
            $this->deleteHandle(getThumbName($this->image,$thumb['name']));
        }
    }
}
