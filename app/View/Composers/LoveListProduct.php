<?php

namespace App\View\Composers;

use Illuminate\View\View;

class LoveListProduct
{
    public $loveList;
    public function __construct()
    {
        if (session()->has('love_cart')) {
            return $this->loveList = session()->get('love_cart');
        }
        return $this->loveList = null;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('love_list', $this->loveList);
    }
}
