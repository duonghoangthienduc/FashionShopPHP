<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('admin.main');
        }
    }
    public function logOut(Request $request)
    {
        return redirect('admin/login')->with(Auth::logout());
    }
}
