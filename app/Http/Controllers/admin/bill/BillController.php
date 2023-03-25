<?php

namespace App\Http\Controllers\admin\bill;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\admin\Bill;
use App\Models\admin\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Exception;

class BillController extends Controller
{
    public function index()
    {
        $datas = Bill::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pages.bill.list', compact('datas'));
    }

    public function edit(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $bill = Bill::where('id', $id)->first();

            $query = $bill->update([
                'status' => $request->input('status')
            ]);
            if ($query) {
                DB::commit();
                Session::flash('success', 'Cập nhật thành công');
                return redirect('admin/bill');
            }
        } catch (Exception $err) {
            DB::rollback();
        }
        return back()->withErrors(['error' => $err->__toString()]);
    }

    public function sendMail($id)
    {
        $gmail = Customer::where('bill_id',$id)->get('email');
        $bills = Bill::where('id',$id)->get();
        // dd($gmail[0]['email']);
        $res = Mail::to($gmail[0]['email'])->send(new OrderShipped($bills));
        if($res){
            return back();
        }
        return back();
    }
}
