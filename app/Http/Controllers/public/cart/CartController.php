<?php

namespace App\Http\Controllers\public\cart;

use App\Http\Controllers\Controller;
use App\Models\admin\Bill;
use App\Models\admin\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Carbon;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = session()->get('cart');
        return view('public.pages.cart.shopingCart', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carts = session()->get('cart');

        $total = 0;
        foreach ($carts as $key => $cart) {
            $total += $cart['price'] * $cart['qty'];
        }


        $provinces = \Kjmtrue\VietnamZone\Models\Province::get();

        return view('public.pages.cart.checkOutCart', compact('provinces', 'total', 'carts'));
    }

    public function getDistricts($id)
    {
        if ($id == 0) {
            return;
        }
        $districts = \Kjmtrue\VietnamZone\Models\District::whereProvinceId($id)->get();

        return $districts->toJson(JSON_PRETTY_PRINT);
    }

    public function getWards($id)
    {
        if ($id == 0) {
            return;
        }
        $wards = \Kjmtrue\VietnamZone\Models\Ward::whereDistrictId($id)->get();

        return $wards->toJson(JSON_PRETTY_PRINT);
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
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'province'  => 'required',
            'district'  => 'required',
            'ward'  => 'required',
        ], [
            'first_name.required' => 'Yêu cầu cung cấp cho cửa hàng để tiện liên lạc',
            'first_name.min' => 'Độ dài họ không hợp lệ',
            'last_name.required' => 'Yêu cầu cung cấp cho cửa hàng để tiện liên lạc',
            'last_name.min' => 'Độ dài tên không hợp lệ',
            'email.required' => 'Yêu cầu cung cấp cho cửa hàng để tiện liên lạc',
            'email.email' => 'Sai định dạng mail',
            'phone.required' => 'Yêu cầu cung cấp cho cửa hàng để tiện liên lạc',
            'phone.numeric' => 'Sai định dạng số điện thoại',
            'address.required' => 'Yêu cầu cung cấp cho cửa hàng để tiện liên lạc',
            'province.required' => 'Yêu cầu cung cấp cho cửa hàng để tiện liên lạc',
            'district.required' => 'Yêu cầu cung cấp cho cửa hàng để tiện liên lạc',
            'ward.required' => 'Yêu cầu cung cấp cho cửa hàng để tiện liên lạc',
        ]);


        $carts = session()->get('cart');
        $pro_id = [];
        $pro_qty = [];
        $pro_size = [];
        $pro_price = [];
        if (session()->has('cart')) {
            foreach ($carts as $cart) {
                $pro_id = array_merge($pro_id, [$cart['id']]);
                $pro_qty = array_merge($pro_qty, [$cart['qty']]);
                $pro_size = array_merge($pro_size, [$cart['size']]);
                $pro_price = array_merge($pro_price, [$cart['price']]);
            }
        }

        $prod_id = implode(", ", $pro_id);

        $prod_qty = implode(", ", $pro_qty);

        $prod_price = implode(", ", $pro_price);

        $prod_size = implode(", ", $pro_size);

        try {
            DB::beginTransaction();
            $bill = Bill::query()
                ->insertGetId(
                    [
                        'address' => $request->input('address'),
                        'province_id' => $request->input('province'),
                        'district_id' => $request->input('district'),
                        'ward_id' => $request->input('ward'),
                        'note' => $request->input('note'),
                        'prod_id' => $prod_id,
                        'prod_qty' => $prod_qty,
                        'prod_price' =>  $prod_price,
                        'prod_size' =>   $prod_size,
                        'created_at' => Carbon::now(),
                        'status' => 0,
                    ]
                );

            $customer = Customer::query()
                ->create(
                    [
                        'first_name' => $request->input("first_name"),
                        'last_name' => $request->input('last_name'),
                        'email' => $request->input('email'),
                        'phone' => $request->input('phone'),
                        'bill_id' => $bill,
                    ]
                );

            // dd($bill);
            if ($customer) {
                DB::commit();
                Session::flash('success', 'Đặt hàng thành công');
                session()->pull('cart');
                return redirect('/');
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
        //
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
    public function changeQuantity(Request $request, $id)
    {
        $carts = session()->get('cart');
        $qty = $request->input('qty');

        if (session()->has('cart')) {
            foreach ($carts as $key => $cart) {
                if ($key == $id) {
                    if ($qty == 0) {
                        return back();
                    }
                    $carts[$key]['qty'] = $qty;
                    session()->flash('success', 'Bạn đã cập nhật sản phẩm thành công');
                    session()->put('cart',  $carts);
                    return back();
                }
            }
        }
    }

    public function removeCart($id)
    {
        $carts = session()->get('cart');

        if (session()->has('cart')) {
            foreach ($carts as $key => $cart) {
                if ($key == $id) {
                    unset($carts[$key]);
                }
            }
        }
        session()->flash('success', 'Xóa thành công');
        session()->put('cart',  $carts);
        return back();
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
}
