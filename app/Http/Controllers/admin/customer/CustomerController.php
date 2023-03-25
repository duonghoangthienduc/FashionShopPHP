<?php

namespace App\Http\Controllers\admin\customer;

use App\Http\Controllers\Controller;
use App\Models\admin\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $datas = Customer::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.customer.list', compact('datas'));
    }
}
