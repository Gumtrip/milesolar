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
        return view('frontend.sample.index')->with(compact('samples', 'breads'));

    }

    public function show(Request $request,Sample $sample){
        $breads = [
            ['title' => 'samples', 'url' => route('samples')],
            ['title' => $sample->title, 'url' => route('samples.show', [$sample, $sample->slug])]
        ];
        return view('frontend.sample.show')->with(compact('sample', 'breads'));

    }
}
