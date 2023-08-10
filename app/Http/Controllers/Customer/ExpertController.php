<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\Customer\UpdateExpertRequest;
use App\Models\Customer;
use App\Models\Expert;
use App\Models\Profession;
class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professions = Profession::where('status',1)->get();
        $social_network = auth('customer')->user()->expert ? json_decode(auth('customer')->user()->expert->social_network,true) : null;
        return view('customer.expert.index',compact('social_network','professions'));
    }


    public function update(UpdateExpertRequest $request, Customer $customer)
    {
        // upate info expert on table customer
        $data = $request->only('fullname','email');
        $data['slug'] = Str::slug( $request->fullname, '-');

        if($request->password){
            $data['password']= Hash::make($request->password);
        }

        if($request->file('avatar')){
            $data['avatar'] =  $this->uploadFile($request->avatar);
        }

        $data['phone'] = $request->phone;
        $data['regular_address'] = $request->regular_address;
        $data['description'] = $request->description;
        $data['status'] = 2;
        $customer->update($data);

        // update info expert on table expert
        $expert = $request->only('profession_id','birthday','gender','nationality','marital_status','current_address','content');
        $expert['social_network'] = json_encode($request->social_network);

        // case expert news
        if(!$customer->expert){
            $expert['customer_id'] = $customer->id;
            Expert::create($expert);
            return redirect()->back()->with('success','Bạn đã thêm thông tin thành công');
        }

        // case expert exists
        $customer->expert->update($expert);
        return redirect()->back()->with('success','Bạn đã cập nhật thông tin thành công');
    }
}
