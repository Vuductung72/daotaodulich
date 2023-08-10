<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use App\Models\Profession;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Exam;
use App\Models\CourseBuy;
use App\Models\Benefit;
class CoursesController extends Controller
{
    public function search(Request $request)
    {
        $courses = Course::Where('name', 'like', '%' .$request->course. '%')->orderBy('id', 'DESC')->paginate(7);
        return view('admin.courses.index', compact('courses'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('id','DESC')->paginate(7);
        return view('admin.courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_profession = Profession::where('status',1)->get();
        $list_exam = Exam::where(['type'=>1,'status'=>1])->get();
        $list_exam_test = Exam::where(['type'=>0,'status'=>1])->get();
        return view('admin.courses.create',compact('list_profession','list_exam','list_exam_test'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCourseRequest $request)
    {
        // create new course
        $new_course = $request->only('name','price','price_sale','time_sale','describe','description','profession_id','exam_id_test','keyword');
        $new_course['slug'] = Str::slug( $request->name, '-');
        $new_course['exam_id'] = 0;

        if($request->thumb != null){
            $new_course['thumb'] = $this->uploadFile($request->thumb);
        }else{
            $new_course['thumb'] = asset('/images/no_image.png');
        }

        $course = Course::create($new_course);

        // create benefit of course
        if($request->content != []){
            $benefits= [];
            foreach ($request->content as $value) {
                if ( !($value == null)) {
                    array_push($benefits,array('course_id'=>$course->id,'content'=>$value));
                }
            }
            Benefit::insert($benefits);
        }

        return redirect()->route('ad.courses.index')->with('success', 'Thêm khóa học thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $list_profession = Profession::all();
        $list_exam = Exam::where(['type'=>1,'status'=>1])->get();
        $list_exam_test = Exam::where(['type'=>0,'status'=>1])->get();
        return view('admin.courses.edit',compact('list_profession','course','list_exam','list_exam_test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request,Course $course)
    {
        // update course current
        $update_course = $request->only('name','price','price_sale','time_sale','describe','description','profession_id','exam_id_test','keyword');
        $update_course['slug'] = Str::slug( $request->name, '-');
        if($request->thumb != null){
            $update_course['thumb'] = $this->uploadFile($request->thumb);
        }
        $course->update($update_course);

        // add benefit for course
        if($request->content != []){
            $benefits = [];
            foreach ($request->content as $value) {
                if ( !($value == null)) {
                    array_push($benefits,array('course_id'=>$course->id,'content'=>$value));
                }
            }

            Benefit::insert($benefits);
        }

        return redirect()->route('ad.courses.index')->with('success', 'Cập nhật khóa học thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courseBuyed= CourseBuy::where('course_id',$id)->count();
        if($courseBuyed) return redirect()->back()->with('info', 'Khóa học đã được đăng ký! Không thể xóa');
        Lesson::where('course_id',$id)->delete();
        Benefit::where('course_id',$id)->delete();
        Course::destroy($id);

        return redirect()->route('ad.courses.index')->with('success', 'Xóa khóa học thành công');
    }

    public function getFeedbackByCourse(Course $course){
        $feedbacks = $course->feedbacks;
        return view('admin.feedbacks.index',compact('feedbacks'));
    }

    public function updateStatus(Course $course){
        // dd($course);
        if($course->status === 0){
            $course->status = 1;
            $course->save();
        }else{
            $course->status = 0;
            $course->save();
        }
        return back()->with('success','Cập nhật thành công');
    }
}
