<?php

namespace App\View\Components\public;

use Illuminate\View\Component;

class BreadCrumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $breadName;
    public function __construct()
    {
        $this->breadName = Request()->route()->getName();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.public.breadcrumb', [$this->breadName]);
    }
}
