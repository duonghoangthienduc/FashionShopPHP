<?php

namespace App\View\Composers;

use App\Http\Controllers\admin\banner\BannerController;

use Illuminate\View\View;

class BannerCarousel
{
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $bannerController = new BannerController;
        $datas = $bannerController->show();
        $view->with('banner_carousel', $datas);
    }
}
