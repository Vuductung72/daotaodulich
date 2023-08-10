<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Internship;
use App\Models\Customer;
class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::where('type',2)->get();
        return view('admin.internships.index',compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        // $customer = $internship->customer;
        
        // $internship_professions = json_decode($internship->profession_id);
        // $professions='';
        // foreach ($internship_professions as $profession) {
        //     $professions .=  " $profession->name,";
        // }
        // $professions = rtrim(trim($professions), ",");

        return view('admin.internships.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Customer $customer)
    {
        if($customer->status == 2 ){
            $customer->update(['status' => 1]);
            return redirect()->back()->with('success','Hủy xác nhận thành công');
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
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $customers = Customer::Where('name', 'like', '%' .$request->internship. '%')->where('type',2)->orderBy('id', 'DESC')->get();
        $internship = $request->internship;
        return view('admin.internships.index', compact('customers','internship'));
    }
}
