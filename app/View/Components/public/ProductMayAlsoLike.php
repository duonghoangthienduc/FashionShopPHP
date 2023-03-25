<?php

namespace App\View\Components\public;

use App\Http\Controllers\admin\product\ProductController;
use Illuminate\View\Component;

class ProductMayAlsoLike extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $proId;
    public function __construct($id = '', $proId = '')
    {
        $this->id = $id;
        $this->proId = $proId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $productController = new ProductController;
        $datas = $productController->showProductMayLike($this->id, $this->proId);
        return view('components.public.product-may-also-like', compact('datas'));
    }
}
