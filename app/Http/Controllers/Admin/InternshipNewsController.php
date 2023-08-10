<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\Profession;
use App\Models\UserCustomer;
use Illuminate\Http\Request;

class InternshipNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = UserCustomer::where('type', 1);
        $internships = Internship::orderBy('id', 'DESC')->paginate(7);
        return view('admin.news_internships.index', compact('internships', 'count'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Internship $internship)
    {
        $count = UserCustomer::where('type', 1)->where('internship_id', $internship->id)->get()->count();
        $professions = Profession::all();
        return view('admin.news_internships.edit', compact('internship', 'professions', 'count'));
    }

    public function status(Internship $internship)
    {
        if($internship->status == 1){
            $internship->update(['status'=> 0]);
            return back()->with('success','Ẩn tin tuyển dụng thành công!');
        }else{
            $internship->update(['status'=> 1]);
            return back()->with('success','Hiện tin tuyển dụng thành công!');
        }
    }

    public function search(Request $request)
    {
        $internships = Internship::Where('title', 'like', '%' .$request->title. '%')->orderBy('id', 'DESC')->paginate();
        return view('admin.news_internships.index', compact('internships'));
    }

    public function listIntern(Internship $internship){
        $users = UserCustomer::where('type', 1)->where('internship_id',$internship->id)->orderBy('id', 'DESC')->paginate();
        return view('admin.news_internships.list_intern', compact('internship','users'));
    }

    public function showIntern(Internship $internship, UserCustomer $userCustomer){
        if ($userCustomer->status == 2) {
            return view('admin.news_internships.show_intern', compact('internship', 'userCustomer'));
        } else {
            return back()->with('info','Người ứng tuyển chưa được xác nhận');
        }
    }
}
