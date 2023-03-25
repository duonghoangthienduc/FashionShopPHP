<?php

namespace App\View\Composers;

use App\Http\Controllers\admin\product\ProductController;
use Illuminate\View\View;

class RecentProduct
{
    public $recentProduct;
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
        $productController = new ProductController;
        $this->recentProduct = $productController->showRecentProudct();
        $view->with('recent_product', $this->recentProduct);
    }
}
