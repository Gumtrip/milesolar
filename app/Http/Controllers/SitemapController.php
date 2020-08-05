<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravelium\Sitemap\Sitemap;
use App\Services\SitemapService;
use URL;
class SitemapController extends Controller
{
    public function index(SitemapService $sitemap)
    {
        return $sitemap->generate()->render('xml');
    }
}
