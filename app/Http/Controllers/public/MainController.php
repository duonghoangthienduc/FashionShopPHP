<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function searchProduct(Request $request)
    {
        $name =  $request->input('product_find');
        $datas = Product::where('name_product', 'like', '%' . $name . '%')->orderBy('id', 'asc')->paginate(10);
        return view('public.pages.product.list_product', compact('datas'));
    }

    public function filterByPrice(Request $request)
    {
        $datasRequest = [];
        if ($request->input('price') != null) {
            $datasRequest = $request->input('price');
            $conditionals = explode(", ", $datasRequest[count($datasRequest) - 1]);
            $variable_a = 0;
            $variable_b = 0;
            if (count($conditionals) > 1) {
                $variable_a = $conditionals[0];
                $variable_b = $conditionals[1];
            } else {
                $variable_a = $conditionals[0];
            }
            $check_datas = Product::where('new_price', 0)->first();
            if ($variable_b != 0) {
                if ($check_datas == null) {
                    $datas = Product::whereBetween('new_price', [$variable_a,  $variable_b])->orderBy('id', 'asc')->paginate(10);
                } else {
                    $datas = Product::whereBetween('old_price', [$variable_a,  $variable_b])->orderBy('id', 'asc')->paginate(10);
                }
            } else {
                if ($check_datas == null) {
                    $datas = Product::where('new_price', '>', $variable_a)->orderBy('id', 'asc')->paginate(10);
                } else {
                    $datas = Product::where('old_price', '>', $variable_a)->orderBy('id', 'asc')->paginate(10);
                }
            }
            return view('public.pages.product.list_product', compact('datas'));
        }
        return back();
    }

    public function storeLike($id)
    {
        $datas = Product::where('id', $id)->get();

        $idProd = '';
        $nameProd = '';
        $price = '';
        $thumb = '';

        foreach ($datas as $data) {
            $idProd .= $data->id;
            $nameProd .= $data->name_product;
            if ($data->new_price != 0) {
                $price .= $data->new_price;
            } else {
                $price .= $data->old_price;
            }
            $thumb .= $data->thumb;
        }

        $item = array(
            'id' => $idProd,
            'name' =>  $nameProd,
            'price' => $price,
            'image' => $thumb
        );

        $carts = session()->get('love_cart');

        if (session()->has('love_cart')) {
            foreach ($carts as $key => $cart) {
                if ($item['id'] == $carts[$key]['id']) {
                    Session::flash('success', 'Bạn đã yêu thích sản phẩm này rồi !!!');
                    return back();
                }
            }
        }
        session()->push('love_cart', $item);
        Session::flash('success', 'Bạn đã yêu thích sản phẩm thành công');
        return back();
    }

    public function storeToCart(Request $request)
    {
        $request->validate([
            'size' => 'required',
        ], [
            'size.required' => 'Hãy chọn kích thước bạn muốn mua'
        ]);

        $item = $request->all();

        $carts = session()->get('cart');
        // dd($item);

        if (session()->has('cart')) {
            foreach ($carts as $key => $cart) {
                if ($item['id'] == $carts[$key]['id'] && $item['size'] == $carts[$key]['size']) {
                    $carts[$key]['qty'] += $item['qty'];
                    Session::flash('success', 'Bạn đã cập nhật sản phẩm thành công');
                    session()->put('cart',  $carts);
                    return back();
                }
            }
        }

        session()->push('cart', $item);
        Session::flash('success', 'Bạn đã thêm sản phẩm vào giỏ hàng thành công');

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    public function removeFromList($id)
    {
        $products = Session::get('love_cart');
        foreach ($products as $key => $product) {
            if ($products[$key]['id'] == $id) {
                unset($products[$key]);
            }
        }
        Session::flash('success', 'Xóa thành công');
        Session::put('love_cart', $products);
        return back();
    }
}
