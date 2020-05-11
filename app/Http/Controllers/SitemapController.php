<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravelium\Sitemap\Sitemap;
use App\Models\Product\Product;
use App\Models\Sample\Sample;
use App\Models\Article\Article;
use App\Services\SitemapService;
use URL;
class SitemapController extends Controller
{
    public function index(SitemapService $sitemap)
    {
        return $sitemap->generate()->render('xml');
    }
}
