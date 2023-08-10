<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Models\Customer;
class RegisterController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(auth('customer')->user()){
            if(auth('customer')->user()->type == 1) return redirect()->route('us.expert.index');
            if(auth('customer')->user()->type == 2) return redirect()->route('us.internship.index');
        }
        return view('customer.login.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {
        // create account for customer
        $customer = $request->only('fullname','email','type');
        $customer['slug'] = Str::slug( $request->fullname, '-');
        $customer['avatar'] =  ($request->type == 1) ? config('constant.user_no_image') : config('constant.no_image');
        $customer['password'] = Hash::make($request->password);
        $customer = Customer::create($customer);
        $request->session()->flash('success', 'Đăng ký thành công');

        // auto login when success register customer
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('customer')->attempt($login)) {
            if(auth('customer')->user()->type == 1) return redirect()->route('us.expert.index');
            return redirect()->route('us.internship.index');
        }

        return redirect()->route('us.login.index');
    }

}
