<?php

namespace App\View\Components\public;

use Illuminate\View\Component;

class ProductAction extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $product_id;
    public function __construct($id = '')
    {
        $this->product_id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.public.product-action', [$this->product_id]);
    }
}
