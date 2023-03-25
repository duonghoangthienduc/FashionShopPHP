<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class ContentHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $contentTitle;
    public function __construct()
    {
        $this->contentTitle = Request()->route()->getName();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.content-header', [$this->contentTitle]);
    }
}
