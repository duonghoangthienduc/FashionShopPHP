<?php

namespace App\View\Composers;

use App\Http\Controllers\admin\category\CategoryController;
use Illuminate\View\View;

class CategoryDropDownMenu
{
    public $menus;
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
        $this->menus = self::menuView($datas);
        $view->with('menu_dropdown', $this->menus);
    }

    public static function menuView($datas, $parentId = 0)
    {
        $html = '';
        foreach ($datas as $category) {
            if ($category->parent_id == $parentId) {
                if (self::countChild($category->id, $datas) == 0) {
                    $html .= '<a href="' . $category->id . '" class="dropdown-item">
                ' . $category->name_category . '
                </a>';
                }
                if (self::isChild($category->id, $datas)) {
                    $html .= self::menuView($datas, $category->id);
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
