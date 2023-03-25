<?php

namespace App\Http\Controllers\admin\banner;

use App\Http\Controllers\Controller;
use App\Models\admin\Banner;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Banner::paginate(10);
        return view('admin.pages.banner.list', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_banner' => 'required|min:5',
            'thumb' => 'required|image'
        ], [
            'name_banner.required' => 'Tên banner không được để trống',
            'name_banner.min' => 'Tên banner ít nhất 5 ký tự',
            'thumb.image' => 'Thư mục cập nhật không phải hình ảnh',
            'thumb.required' => 'Thư mục hình ảnh không được để trống',
        ]);
        try {
            DB::beginTransaction();

            $path = Storage::putFile(
                'public/banner/' . date('Y/m/d'),
                $request->file('thumb'),
            );

            $nameFile = str_replace('public/', "/storage/", $path);

            $data = Banner::query()
                ->create(array_merge($request->all(), ['thumb' => $nameFile]));

            if ($data) {
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
        $datas  = Banner::where('is_active', 1)->get();
        return $datas;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $data = $banner;
        return view('admin.pages.banner.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'thumb' => 'image',
        ], [
            'thumb.image' => 'Đây không phải là hình ảnh'
        ]);

        try {
            DB::beginTransaction();

            $path = $request->input('img_category');

            $pathName = str_replace('/storage', '/public', $path);

            $newFile = $request->file('thumb');

            $nameFile = '';


            if ($newFile != null) {
                Storage::delete($pathName);

                $newPath = Storage::putFile(
                    'public/banner/' . date('Y/m/d'),
                    $request->file('thumb'),
                );

                $nameFile .= str_replace('public/', "/storage/", $newPath);

                $query = $banner
                    ->update([
                        'name_banner' => $request->input('name_banner'),
                        'number_sort' => (int) $request->input('number_sort'),
                        'banner_content' => $request->input('banner_content'),
                        'thumb' => $nameFile,
                        'is_active' => $request->input('is_active')
                    ]);
            } else {
                $query = $banner
                    ->update([
                        'name_banner' => $request->input('name_banner'),
                        'number_sort' => (int) $request->input('number_sort'),
                        'banner_content' => $request->input('banner_content'),
                        'thumb' =>  $path,
                        'is_active' => $request->input('is_active')
                    ]);
            }

            if ($query) {
                DB::commit();
                Session::flash('success', 'Cập nhật thành công');
                return redirect('admin/banner');
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
        try {
            DB::beginTransaction();

            $data = Banner::where('id', $id)->first();

            $path = $data->thumb;

            $pathName = str_replace('/storage', '/public', $path);

            Storage::delete($pathName);

            $query = $data->delete();
            if ($query) {
                DB::commit();
                Session::flash('success', 'Đã xóa thành công dữ liệu');
                // return redirect('admin/banner');
                return back();
            }
        } catch (Exception $err) {
            DB::rollback();
        }
        return back()->withErrors(['error' => $err->__toString()]);
    }
}
