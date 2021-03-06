<?php


namespace App\Http\Controllers\Frontend\Sample;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sample\Sample;
class SampleController extends Controller
{
    public function index(Request $request){
        $samples = Sample::paginate(config('app.page_size'));
        $breads = [['title' => 'samples', 'url' => route('samples')]];
        return view(cusView('sample.index'),compact('samples', 'breads'));

    }

    public function show(Request $request,Sample $sample){
        $breads = [
            ['title' => 'samples', 'url' => route('samples')],
            ['title' => $sample->title, 'url' => route('samples.show', [$sample, $sample->slug])]
        ];
        return view(cusView('sample.show'),compact('sample', 'breads'));

    }
}
