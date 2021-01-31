<?php


namespace App\Http\Controllers\Frontend\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page\Page;

class PageController extends Controller
{
    public function show(Request $request, Page $page)
    {
        $breads = [
            ['title' => $page->title, 'url' => route('pages.show', [$page, $page->slug])]
        ];

        return view(cusView('page.show'), compact('page', 'breads'));
    }
}
