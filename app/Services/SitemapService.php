<?php


namespace App\Services;
use Laravelium\Sitemap\Sitemap;
use App\Models\Product\Product;
use App\Models\Sample\Sample;
use App\Models\Article\Article;
use URL;

class SitemapService
{


    public function generate($device='web')
    {
        $sitemap = app('sitemap');;
        $sitemap->setCache('milesolar_sitemap', 60);
        $baseUrl = $device=='mobile'?config('app.m_url'):config('app.url');
        if(!$sitemap->isCached()){
            $sitemap->add(URL::to('/'), null, '1.0', 'daily');
//产品
            Product::chunk(100,function($products)use($sitemap,$baseUrl){
                foreach($products as $product){
                    $sitemap->add($baseUrl.('/products/'.$product->id.'/'.$product->slug), $product->updated_at->toAtomString(), 0.8, 'daily');
                }
            });

//案例
            Sample::chunk(100,function($samples)use($sitemap,$baseUrl){
                foreach($samples as $sample){
                    $sitemap->add($baseUrl.('/cases/'.$sample->id.'/'.$sample->slug), $sample->updated_at->toAtomString(), 0.8, 'daily');
                }
            });
//文章
            Article::chunk(100,function($articles)use($sitemap,$baseUrl){
                foreach($articles as $article){
                    $sitemap->add($baseUrl.('/articles/'.$article->id.'/'.$article->slug), $article->updated_at->toAtomString(), 0.8, 'daily');
                }
            });
//CONTACT US
            $sitemap->add($baseUrl.('/contact'), today()->toAtomString(), 0.8, 'daily');

        }
        return $sitemap;
    }
}
