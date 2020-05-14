<?php


namespace App\Services;
use Laravelium\Sitemap\Sitemap;
use App\Models\Product\Product;
use App\Models\Sample\Sample;
use App\Models\Article\Article;
use URL;

class SitemapService
{


    public function generate()
    {
        $sitemap = app('sitemap');;
        $sitemap->setCache('milesolar_sitemap', 60);
        if(!$sitemap->isCached()){
            $sitemap->add(URL::to('/'), null, '1.0', 'daily');
//产品
            Product::chunk(100,function($products)use($sitemap){
                foreach($products as $product){
                    $sitemap->add(URL::to('/products/'.$product->id), $product->updated_at->toAtomString(), 0.8, 'daily');
                }
            });

//案例
            Sample::chunk(100,function($samples)use($sitemap){
                foreach($samples as $sample){
                    $sitemap->add(URL::to('/cases/'.$sample->id), $sample->updated_at->toAtomString(), 0.8, 'daily');
                }
            });
//文章
            Article::chunk(100,function($articles)use($sitemap){
                foreach($articles as $article){
                    $sitemap->add(URL::to('/contact'), $article->updated_at->toAtomString(), 0.8, 'daily');
                }
            });
//CONTACT US
            $sitemap->add(URL::to('/contact'), today()->toAtomString(), 0.8, 'daily');

        }
        return $sitemap;
    }
}
