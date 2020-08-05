<?php


namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 使用基于合成器的类
        View::composer(
            'frontend.*', 'App\Http\View\Composers\FrontendComposer'
        );


    }
}
