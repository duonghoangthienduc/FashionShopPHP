<?php

namespace App\Providers;

use App\View\Composers\BannerCarousel;
use App\View\Composers\CategoryDropDownMenu;
use App\View\Composers\CategoryMenu;
use App\View\Composers\LoveListProduct;
use App\View\Composers\RecentProduct;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('public.navbarView.navbar', CategoryMenu::class);
        View::composer('public.navbarView.dropDownMenu', CategoryDropDownMenu::class);
        View::composer('public.carouselView.carousel', BannerCarousel::class);
        View::composer('public.productView.recentProduct', RecentProduct::class);
        View::composer('public.pages.product.love_list_product', LoveListProduct::class);
    }
}
