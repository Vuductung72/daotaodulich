<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\Customer\CreateInternshipRequest;
use App\Models\Profession;
use App\Http\Requests\Customer\UpdateInternshipRequest;
use App\Models\Customer;
use App\Models\Internship;
use App\Models\UserCustomer;

class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $internship_profession = auth('customer')->user()->internship ? json_decode(auth('customer')->user()->internship->profession_id) : [];
        $professions = Profession::all();
        $internships = Internship::where('customer_id', auth('customer')->user()->id)->orderBy('id', 'DESC')->paginate(7);
        return view('customer.internship.index',compact('professions','internship_profession', 'internships'));
    }

    public function update(UpdateInternshipRequest $request, Customer $customer)
    {

        // upate info internship on table customer
        $data = $request->only('fullname','description','regular_address','phone');
        $data['slug'] = Str::slug( $request->fullname, '-');
        if($request->password){
            $data['password']= Hash::make($request->password);
        }
        $data['status'] = 2;
        if($request->file('avatar')){
            $data['avatar'] =  $this->uploadFile($request->avatar);
        }
        $customer->update($data);
        return redirect()->back()->with('success','Bạn đã cập nhật thông tin thành công');
    }

    public function jsonProfessions($professions){
        $professions = Profession::select('id', 'name')->whereIn('id',$professions)->get();
        return json_encode($professions);
    }

    public function recruitment()
    {
        $professions = Profession::all();
        return view('customer.internship.recruitment', compact('professions'));
    }

    public function createRecruitment(CreateInternshipRequest $request)
    {
        try {
            $data = $request->only('title','profession_id','describe','quantity','wage','time','start_time', 'status');
            $data['slug'] = Str::slug( $request->title, '-');
            $data['customer_id'] = auth('customer')->user()->id;
            Internship::create($data);
            return redirect()->route('us.internship.index')->with('success','Bạn đã thêm thông tin tuyển dụng thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('warning','Bạn đã thêm thông tin thất bại!');
        }
    }

    public function editRecruitment(Internship $internship)
    {
        $professions = Profession::all();
        $count = UserCustomer::where('type', 1)->where('internship_id', $internship->id)->get()->count();
        $users = UserCustomer::where('type', 1)->where('internship_id',$internship->id)->orderBy('id', 'DESC')->paginate(10);
        return view('customer.internship.edit-recruitment', compact('professions', 'internship','count', 'users'));
    }

    public function updateRecruitment(CreateInternshipRequest $request, Internship $internship)
    {
        try {
            $data = $request->only('title','profession_id','describe','quantity','wage','time','start_time', 'status');
            $data['slug'] = Str::slug( $request->title, '-');
            $internship->update($data);
            return redirect()->back()->with('success','Bạn đã cập nhật thông tin tuyển dụng thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('warning','Bạn đã cập nhật thông tin tuyển dụng thất bại!');
        }
    }

    public function status(Internship $internship)
    {
        if($internship->status == 1){
            $internship->update(['status'=> 0]);
        }else{
            $internship->update(['status'=> 1]);
        }

        return back()->with('success','Cập nhật thành công!');
    }

    public function search(Request $request)
    {
        $internships = Internship::Where('title', 'like', '%' .$request->internship. '%')->orderBy('id', 'DESC')->paginate();
        return view('customer.internship.index', compact('internships'));
    }

    public function statusRecruitment(UserCustomer $userCustomer)
    {
        if ($userCustomer->content == null) {
            if($userCustomer->status == 1){
                $userCustomer->update(['status'=> 2]);
            }
            else if($userCustomer->status == 2){
                $userCustomer->update(['status'=> 3]);
            }
            else if($userCustomer->status == 3){
                $userCustomer->update(['status'=> 2]);
            }
            return back()->with('success','Cập nhật thành công!');
        } else {
            return back()->with('info','Học viên đang thực tập không thể cập nhật');
        }
    }

    public function evaluate(Internship $internship, UserCustomer $userCustomer){
        if ($userCustomer->status == 2) {
            return view('customer.internship.evaluate', compact('internship', 'userCustomer'));
        } else {
            return back()->with('info','Người ứng tuyển chưa được xác nhận');
        }
    }

    public function evaluatePost(Request $request, Internship $internship, UserCustomer $userCustomer){
        $data = $request->only('content');
        $userCustomer->update($data);
        return back()->with('success','Đánh giá thành công!');
    }
}
