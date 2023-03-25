<?php

namespace App\Providers;

use App\View\Components\admin\ContentHeader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Alert;
use App\View\Components\public\BreadCrumb;
use App\View\Components\public\ProductAction;
use App\View\Components\public\ProductItem;
use App\View\Components\public\ProductMayAlsoLike;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('alert', Alert::class);
        Blade::component('contentHeader', ContentHeader::class);
        Blade::component('breadCrumb', BreadCrumb::class);
        Blade::component('youMayAlsoLike', ProductMayAlsoLike::class);
        Blade::component('productAction', ProductAction::class);
    }
}
