<?php

namespace App\Http\Controllers\admin\product;

use App\Http\Controllers\Controller;
use App\Models\admin\Category;
use App\Models\admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Product::paginate(5);
        return view('admin.pages.product.list', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_datas  = Category::all();
        foreach ($category_datas as $key => $category_data) {
            if (self::isChild($category_data->id, $category_datas)) {
                unset($category_datas[$key]);
            }
        }
        return view('admin.pages.product.add', ['datas' => $category_datas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            if ($request->input('old_price') < $request->input('new_price')) {
                return back()->withErrors(['error' => 'Gía gốc phải lớn hơn giá mới']);
            }

            $path = Storage::putFile(
                'public/product/' . date('Y/m/d'),
                $request->file('thumb'),
            );

            $nameFile = str_replace('public/', "/storage/", $path);

            $image1 = $request->file('image1');
            $image2 = $request->file('image2');
            $image3 = $request->file('image3');

            $path1 = $path2 = $path3 = '';

            if ($image1 != null) {
                $path1 .= Storage::putFile(
                    'public/product/image/' . date('Y/m/d'),
                    $request->file('image1'),
                );
                $path1 = str_replace('public/', "/storage/", $path1);
            }

            if ($image2 != null) {
                $path2 .= Storage::putFile(
                    'public/product/image/' . date('Y/m/d'),
                    $request->file('image2'),
                );
                $path2 = str_replace('public/', "/storage/", $path2);
            }

            if ($image3 != null) {
                $path3 .= Storage::putFile(
                    'public/product/image/' . date('Y/m/d'),
                    $request->file('image3'),
                );
                $path3 = str_replace('public/', "/storage/", $path3);
            }

            $datas = Product::query()
                ->create(array_merge(
                    $request->all(),
                    [
                        'size' => implode(", ", $request->input('size')),
                        'thumb' => $nameFile,
                        'image1' => $path1,
                        'image2' => $path2,
                        'image3' => $path3
                    ]
                ));

            if ($datas) {
                DB::commit();
                Session::flash('success', 'Đăng thành công');
                return back();
            }
        } catch (Exception $err) {
            DB::rollback();
        }
        return back()->withErrors(['error' => $err->__toString()]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productModel = Product::findOrFail($id);
        $productImage = array($productModel->image1, $productModel->image2, $productModel->image3);
        if (is_null($productModel->image1)) {
            unset($productImage[0]);
        }
        if (is_null($productModel->image2)) {
            unset($productImage[1]);
        }
        if (is_null($productModel->image3)) {
            unset($productImage[2]);
        }
        $size = [];
        if ($productModel->size != null) {
            $size = array_merge($size, explode(', ', $productModel->size));
        }
        $productDetail = [
            'id' => $productModel->id,
            'name_product' => $productModel->name_product,
            'description' => $productModel->description,
            'short_description' => $productModel->short_description,
            'info' => $productModel->info,
            'size' => $size,
            'old_price' => $productModel->old_price,
            'new_price' => $productModel->new_price,
            'thumb' => $productModel->thumb,
            'is_active' => $productModel->is_active,
            'category_id' => $productModel->category_id,
            'product_image' => $productImage,
        ];
        // dd($productModel);
        return view('public.pages.product.product_detail', compact('productDetail'));
    }

    public function showRecentProudct()
    {
        $productModel = Product::where('is_active', 1)->orderBy('id', 'desc')->get();
        $datas = $productModel->take(8);
        return $datas;
    }

    public function showProductMayLike($id, $proId)
    {
        $productModel = Product::orderBy('id', 'desc')->get();
        $datas = $productModel->where('is_active', 1)->where('category_id', $id)->where('id', '!=', $proId)->take(8);
        return $datas;
    }

    public function showProductByCategory($id)
    {
        $datas = Product::where('category_id', $id)->orderBy('id', 'desc')->paginate(9);
        return view('public.pages.product.list_product', compact('datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = Product::where('id', $id)->first();
        $category_datas = Category::all();
        foreach ($category_datas as $key => $category_data) {
            if (self::isChild($category_data->id, $category_datas)) {
                unset($category_datas[$key]);
            }
        }
        return view('admin.pages.product.edit', ['data' => $datas, 'category' => $category_datas]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'thumb' => 'image',
            'image1' => 'image',
            'image2' => 'image',
            'image3' => 'image',
        ], [
            'thumb.image' => 'Đây không phải là hình ảnh',
            'image1.image' =>  'Đây không phải là hình ảnh',
            'image2.image' =>  'Đây không phải là hình ảnh',
            'image3.image' =>  'Đây không phải là hình ảnh',
        ]);
        try {
            DB::beginTransaction();

            $product = Product::where('id', $id)->first();

            if ($request->input('old_price') < $request->input('new_price')) {
                return back()->withErrors(['error' => 'Gía gốc phải lớn hơn giá mới']);
            }

            $size = $request->input('size');

            $path = $request->input('img_thumb');

            $pathName = str_replace('/storage', '/public', $path);

            $newFile = $request->file('thumb');

            //check image 1
            $path1 = $request->input('img_1');

            $pathName1 = str_replace('/storage', '/public', $path1);

            $newImg1 = $request->file('image1');

            //check image 2
            $path2 = $request->input('img_2');

            $pathName2 = str_replace('/storage', '/public', $path2);

            $newImg2 = $request->file('image2');

            //check image 3
            $path3 = $request->input('img_3');

            $pathName3 = str_replace('/storage', '/public', $path3);

            $newImg3 = $request->file('image3');

            $nameFile = '';
            $img1 = '';
            $img2 = '';
            $img3 = '';

            //get new thumb if thumb have new value
            if ($newFile != null) {


                Storage::delete($pathName);


                $newPath = Storage::putFile(
                    'public/product/' . date('Y/m/d'),
                    $request->file('thumb')
                );

                $nameFile .= str_replace('public/', "/storage/", $newPath);
            } else {
                $nameFile .= $path;
            }

            if ($newImg1 != null) {


                Storage::delete($pathName1);


                $newPath1 = Storage::putFile(
                    'public/product/' . date('Y/m/d'),
                    $request->file('image1')
                );

                $img1 .= str_replace('public/', '/storage/', $newPath1);
            } else {
                $img1 .= $path1;
            }

            if ($newImg2 != null) {


                Storage::delete($pathName2);


                $newPath2 = Storage::putFile(
                    'public/product/' . date('Y/m/d'),
                    $request->file('image2')
                );

                $img2 .= str_replace('public/', "/storage/", $newPath2);
            } else {
                $img2 .= $path2;
            }

            if ($newImg3 != null) {


                Storage::delete($pathName3);


                $newPath3 = Storage::putFile(
                    'public/product/' . date('Y/m/d'),
                    $request->file('image3')
                );

                $img3 .= str_replace('public/', "/storage/", $newPath3);
            } else {
                $img3 .= $path3;
            }

            if ($size != null) {
                $query = $product
                    ->update([
                        'name_product' => $request->input('name_product'),
                        'description' => $request->input('description'),
                        'short_description' => $request->input('short_description'),
                        'info' => $request->input('info'),
                        'size' => implode(", ", $request->input('size')),
                        'old_price' => $request->input('old_price'),
                        'new_price' => $request->input('new_price'),
                        'thumb' => $nameFile,
                        'image1' => $img1,
                        'image2' => $img2,
                        'image3' => $img3,
                        'category_id' => $request->input('category_id'),
                        'is_active' => $request->input('is_active'),
                        'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                    ]);
            } else {
                $query = $product
                    ->update([
                        'name_product' => $request->input('name_product'),
                        'description' => $request->input('description'),
                        'short_description' => $request->input('short_description'),
                        'info' => $request->input('info'),
                        'old_price' => $request->input('old_price'),
                        'new_price' => $request->input('new_price'),
                        'thumb' => $nameFile,
                        'image1' => $img1,
                        'image2' => $img2,
                        'image3' => $img3,
                        'category_id' => $request->input('category_id'),
                        'is_active' => $request->input('is_active'),
                        'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                    ]);
            }


            if ($query) {
                DB::commit();
                Session::flash('success', 'Cập nhật thành công');
                // return redirect('admin/product');
                return back();
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

            $data = Product::where('id', $id)->first();

            $path = $data->thumb;

            $pathName = str_replace('/storage', '/public', $path);

            $path1 = $data->image1;

            $pathName1 = str_replace('/storage', '/public', $path1);

            $path2 = $data->image2;

            $pathName2 = str_replace('/storage', '/public', $path2);

            $path3 = $data->image3;

            $pathName3 = str_replace('/storage', '/public', $path3);


            Storage::delete($pathName);


            if ($path1 != null) {
                Storage::delete($pathName1);
            }

            if ($path2 != null) {
                Storage::delete($pathName2);
            }

            if ($path3 != null) {
                Storage::delete($pathName3);
            }

            $query = $data->delete();
            if ($query) {
                DB::commit();
                Session::flash('success', 'Đã xóa thành công dữ liệu');
                return back();
            }
        } catch (Exception $err) {
            DB::rollback();
        }
        return back()->withErrors(['error' => $err->__toString()]);
    }
}
