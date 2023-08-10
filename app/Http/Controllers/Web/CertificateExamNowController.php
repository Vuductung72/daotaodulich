<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificateInformationRequest;
use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Http\Request;

class CertificateExamNowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_slug)
    {
        $course = Course::where('slug', $course_slug)->first();
        $courseUser = CourseUser::where('user_id', customer()->user()->id)->where('course_id', $course->id)->first();
        if ($courseUser == null) {
            return view('web.course.information', compact('course'));
        } else {
            return redirect()->route('w.home')->with('warning','Thông tin của bạn đang chờ xác nhận!');
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CertificateInformationRequest $request, Course $course)
    {
        $data = $request->only('content');
        $data['course_id'] = $course->id;
        $data['user_id'] = customer()->user()->id;
        $data['status'] = 0;
        CourseUser::create($data);
        return redirect()->route('w.course.show',$course->slug)->with('success',"Bạn đã gửi thông tin thành công!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
