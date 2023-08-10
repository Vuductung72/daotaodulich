<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Expert;
class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::where('type',1)->get();
        return view('admin.experts.index',compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin.experts.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $customer = Customer::find($id);

        if($customer->status == 2 ){
            $customer->update(['status' => 1]);
            return redirect()->back()->with('success','Ẩn chuyên gia thành công');
        }

        $customer->update(['status' => 2]);
        return redirect()->back()->with('success','Xác nhận thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $customers = Customer::Where('fullname', 'like', '%' .$request->name. '%')->where('type',1)->orderBy('id', 'DESC')->get();
        return view('admin.experts.index', compact('customers'));
    }
}
