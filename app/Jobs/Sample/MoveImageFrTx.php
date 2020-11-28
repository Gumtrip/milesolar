<?php

namespace App\Jobs\Sample;

use App\Services\ImageHandleService;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Sample\Sample;

class MoveImageFrTx
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $sample;
    const FOLDER = 'sample';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Sample $sample)
    {
        $this->sample = $sample;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = $this->sample->desc;
        $imageHandleService = app(ImageHandleService::class);
        $matches = $imageHandleService->matchImages($content);
        if (isset($matches[1]) && $matches[1]) {
            $content = $imageHandleService->textAreaHandle($content, $matches, self::FOLDER, $this->sample->id);
            if ($content) {
                DB::table('samples')->where('id', $this->sample->id)->update(['desc' => $content]);//富文本图片路径修改
            }
        }
    }
}
