<?php

namespace App\View\Composers;

use App\Http\Controllers\admin\category\CategoryController;
use Illuminate\View\View;

class CategoryMenu
{
    public $datas;
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
        $categorController = new CategoryController;
        $datas = $categorController->show();
        $this->datas = self::menuView($datas);
        $view->with('menu_category', $this->datas);
    }

    public static function menuView($datas, $parentId = 0)
    {
        $html = '';
        foreach ($datas as $category) {
            if ($category->parent_id == $parentId) {
                if (self::countChild($category->id, $datas) == 0) {
                    $html .= '<a href="' . route('Product Shop', $category->id) . '" class="nav-item nav-link">'
                        . $category->name_category .
                        '</a>';
                }
                if (self::countChild($category->id, $datas) != 0) {
                    $html .= '<div class="nav-item dropdown dropright">';
                    $html .= '<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">'
                        . $category->name_category .
                        '<i class="fa fa-angle-right float-right mt-1"></i></a>';
                    if (self::isChild($category->id, $datas)) {
                        $html .= ' <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">';
                        $html .= self::menuView($datas, $category->id);
                        $html .= '</div>';
                    }
                    $html .= '</div>';
                }
            }
        }
        return $html;
    }


    public static function isChild($id, $datas)
    {
        $isChild = false;
        foreach ($datas as $data) {
            if ($id === $data->parent_id) {
                $isChild = true;
                break;
            }
        }
        return $isChild;
    }

    public static function countChild($id, $datas)
    {
        $Child = 0;
        foreach ($datas as $data) {
            if ($id === $data->parent_id) {
                $Child += 1;
            }
        }
        return $Child;
    }
}
