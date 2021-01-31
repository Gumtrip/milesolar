<?php

namespace App\Jobs\Page;

use App\Models\Page\Page;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\ImageHandleService;
use DB;

class MoveImageFrTx
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $page;
    const FOLDER = 'page';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = $this->page->content;
        $imageHandleService = app(ImageHandleService::class);
        $matches = $imageHandleService->matchImages($content);
        if (isset($matches[1]) && $matches[1]) {
            $content = $imageHandleService->textAreaHandle($content, $matches, self::FOLDER, $this->page->id);
            if ($content) {
                DB::table('pages')->where('id', $this->page->id)->update(['content' => $content]);
            }
        }

    }
}
