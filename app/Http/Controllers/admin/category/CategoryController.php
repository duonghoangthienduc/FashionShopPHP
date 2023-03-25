<?php

namespace App\Http\Controllers\admin\category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\InputRequest;
use App\Models\admin\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Category::paginate(5);
        return view('admin.pages.category.list', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Category::all();
        return view('admin.pages.category.add', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InputRequest $request)
    {
        try {
            DB::beginTransaction();

            $datas = Category::query()
                ->create($request->all());

            if ($datas) {
                DB::commit();
                Session::flash('success', 'Đăng thành công');
                return back();
            }
        } catch (Exception $err) {
            DB::rollback();
        }
        return back()->withErrors(['error' => 'Có lỗi vui lòng thử lại']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $datas = Category::all()->where('is_active', '=', '1');
        return $datas;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $datas = Category::all();
        $parent_name = $datas->find($category->parent_id);
        return view(
            'admin.pages.category.edit',
            [
                'datas' => $datas,
                'data' => $category,
                'parent_name' => $parent_name,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        try {
            DB::beginTransaction();

            $query = $category
                ->update([
                    'name_category' => $request->input('name_category'),
                    'parent_id' => (int) $request->input('parent_id'),
                    'is_active' => $request->input('is_active'),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]);

            if ($query) {
                DB::commit();
                Session::flash('success', 'Cập nhật thành công');
                return redirect('admin/category');
            }
        } catch (Exception $err) {
            DB::rollback();
        }
        return back()->withErrors(['error' => $err->__toString()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
