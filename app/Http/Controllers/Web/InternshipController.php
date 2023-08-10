<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Exam;
use App\Models\Internship;
use App\Models\Profession;
use App\Models\Result;
use App\Models\User;
use App\Models\UserCustomer;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $number_internship = $this->getConfigByKey('phan_trang_tin_thuc_tap')->value;
        $internships = Internship::where('status', 1)->whereHas('profession',function (Builder $query){
            $query->where('status','1');
        })->whereHas('customer',function (Builder $query){
            $query->where('status','2');
        })->paginate($number_internship);
        $professions = Profession::where('status',1)->get();

        if(customer()->user()){
            $recruitment = UserCustomer::where(['type' => 1, 'user_id' => customer()->user()->id]);
            $results = Result::where('type',1)->where('status',1)->where('user_id', customer()->user()->id)->get();
            $proInternship = [];
            foreach ($results as $key => $result) {
                $proInternship[$key] = $result->exam->profession_id;
            }
            return view('web.internship.index',compact('internships', 'professions', 'recruitment', 'results', 'proInternship'));
        }
        return view('web.internship.index',compact('internships', 'professions'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($internship_slug)
    {
        // $internship_professions = json_decode($customer->internship->profession_id);
        // $professions='';
        // foreach ($internship_professions as $profession) {
        //     $professions .=  " $profession->name,";
        // }
        // $professions = rtrim(trim($professions), ",");
        $internship = Internship::where('slug', $internship_slug)->first();
        if(customer()->user()){
            $recruitment = UserCustomer::where('type', 1);
            $results = Result::where('type',1)->where('status',1)->where('user_id', customer()->user()->id)->get();
            $proInternship = [];
            foreach ($results as $key => $result) {
                // $result->exam->profession_id;
                $proInternship[$key] = $result->exam->profession_id;
            }
            // dd($proInternship);

            return view('web.internship.show',compact('internship', 'recruitment', 'results', 'proInternship'));
        }
        return view('web.internship.show',compact('internship'));
    }

    public function searchByProfession($slug){
        $number_internship = $this->getConfigByKey('phan_trang_tin_thuc_tap')->value;
        $internships = Internship::where('status', 1)->whereHas('profession',function (Builder $query) use ($slug){
            $query->where(['status' => '1', 'slug' => $slug]);
        })->whereHas('customer',function (Builder $query){
            $query->where('status','2');
        })->paginate($number_internship);

        $professions = Profession::where('status',1)->get();
        $profession = $professions->where('slug',$slug)->first();

        if(customer()->user()){
            $recruitment = UserCustomer::where('type', 1);
            $results = Result::where('type',1)->where('status',1)->where('user_id', customer()->user()->id)->get();
            $proInternship = [];
            foreach ($results as $key => $result) {
                $proInternship[$key] = $result->exam->profession_id;
            }
            return view('web.internship.index',compact('internships', 'professions', 'recruitment', 'results', 'proInternship'));
        }

        return view('web.internship.index',compact('professions', 'internships'));
    }

    public function recruitment(Request $request, Internship $internship)
    {
        $userCustomer['user_id'] = customer()->user()->id;
        $userCustomer['customer_id'] = $internship->customer_id;
        $userCustomer['course_id'] = 0;
        $userCustomer['internship_id'] = $internship->id;
        $userCustomer['confirm_time'] = \Carbon\Carbon::now()->toDateTimeString();
        $userCustomer['status'] = 1;
        $userCustomer['type'] = 1;
        UserCustomer::create($userCustomer);
        return redirect()->back()->with('success', 'Ứng tuyển thành công!');
    }

    public function deleteRecruitment(UserCustomer $userCustomer, Internship $internship)
    {
        $userCustomer = UserCustomer::where('user_id', customer()->user()->id)->where('type', 1)->where('internship_id', $internship->id)->first();
        $userCustomer->delete();
        session()->flash('success', 'Hủy yêu cầu thành công');

        return redirect()->back();
    }
}
