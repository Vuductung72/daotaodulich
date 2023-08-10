<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.login.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $customer = $request->only('email','password');
        if(Auth::guard('customer')->attempt($customer)){
            session()->flash('success', 'Đăng nhập thành công');
            if(auth('customer')->user()->type == 1) return redirect()->route('us.expert.index');
            return redirect()->route('us.internship.index');
        }
        return redirect()->route('us.login.index')->with('warning','Đăng nhập thất bại');

    }

    public function logout()
    {
        session()->flush();
        auth('customer')->logout();
        return redirect()->route('us.login.index')->with('success','Đăng xuất thành công');
    }
}
