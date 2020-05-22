<?php

namespace App\Console\Commands;

use App\Services\SitemapService;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成网站地图';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(SitemapService $sitemap)
    {

        $this->info('正在生成sitemap');
        $sitemap->generate()->store('xml','sitemap');
        $sitemap->generate('mobile')->store('xml','mobile-sitemap');
        $this->info('sitemap完成');

    }
}
