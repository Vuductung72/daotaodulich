<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseBuy;
use App\Models\CourseUser;
use App\Models\Profession;
use App\Models\Feedback;
use App\Models\Expert;
use App\Models\UserCustomer;
use App\Models\Result;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $number_course = $this->getConfigByKey('phan_trang_khoa_hoc')->value;
        $courses = Course::where('status',1)->paginate($number_course);
        $professions = Profession::where('status',1)->get();
        return view('web.course.index',compact('courses','professions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($course_slug)
    {
        $number_feedback = $this->getConfigByKey('phan_trang_danh_gia')->value;
        $course = Course::where('slug',$course_slug)->first();
        $feedbacks = Feedback::where('course_id', $course->id)->paginate($number_feedback);
        $courseUser = customer()->user() ? CourseUser::where('user_id', customer()->user()->id)->where('course_id', $course->id)->first() : null;
        if($feedbacks->count()){
            $avg_star = $feedbacks->sum('star') / $feedbacks->count();
            $avg_star = (int)round($avg_star,0,PHP_ROUND_HALF_UP);
        }else{
            $avg_star = 0;
        }
        $course_buyed = (customer()->user()) ? CourseBuy::where('user_id',auth('user')->user()->id)->where('course_id',$course->id)->count() :  0 ;
        $course_examed = customer()->user() ? Result::where(['user_id' => customer()->user()->id,'course_id' => $course->id, 'type' => 1 ])->count() : 0;
        $course_success = customer()->user() ? Result::where(['user_id' => customer()->user()->id,'course_id' => $course->id,'status' => 1, 'type' => 1 ])->count() : 0;
        return view('web.course.show',compact('course','course_buyed','feedbacks','avg_star', 'courseUser','course_success','course_examed'));
    }

    public function register(Course $course)
    {
        // get price of course to pay
        if($course->price_sale != null){
            if( $course->time_sale == null){
                $price = $course->price_sale;
                goto nexts;
            }
            if($course->time_sale < \Carbon\Carbon::now()){
                $price = $course->price;
            }else{
                $price = $course->price_sale;
            }
        }else{
            $price = $course->price;
        }

        nexts:
        if(customer()->user()->money < $price)  return redirect()->back()->with('info',"Tài khoản của bạn không đủ để đăng ký khóa học. Vui lòng nạp thêm tiền vào tài khoản!");
        $course_buy['user_id'] = customer()->user()->id;
        $course_buy['course_id'] = $course->id;
        CourseBuy::create($course_buy);
        $user['money'] = customer()->user()->money - $price;
        customer()->user()->update($user);
        return redirect()->back()->with('success',"Chúc mừng bạn đã đăng ký khóa học thành công!");
    }

    public function bought()
    {
        $boughts = customer()->user()->courseBuys;
        return view('web.course.bought',compact('boughts'));
    }

    public function getCourseByProfession($slug){
        $professions = Profession::where('status',1)->get();
        $profession = Profession::where('slug',$slug)->first();
        $number_course = $this->getConfigByKey('phan_trang_khoa_hoc')->value;
        $courses = Course::where('profession_id',$profession->id)->where('status',1)->paginate($number_course);
        return view('web.course.index',compact('courses','professions'));
    }

    public function arrange(Request $request)
    {
        // get all course
        $courses = $request->profession_id ? Course::where('profession_id',$request->profession_id)->where('status',1)->get() : Course::all();

        // get course by price sale and news
        if($request->sale == 1 && $request->news == 1){
            $courses = $request->profession_id ? Course::where('profession_id',$request->profession_id)->where('price_sale','>=',0)->orderBy('created_at','DESC')->where('status',1)->limit(6)->get() : Course::where('price_sale','>=',0)->where('status',1)->orderBy('created_at','DESC')->limit(6)->get();
            return view('web.course.search',compact('courses'));
        }

        // get course by price sale
        if($request->sale == 1){
            $courses = $request->profession_id ? Course::where('profession_id',$request->profession_id)->where('status',1)->whereNotNull('price_sale')->get(): Course::whereNotNull('price_sale')->where('status',1)->get();
        }

        // get course news
        if($request->news == 1){
            $courses = $request->profession_id ? Course::where('profession_id',$request->profession_id)->where('status',1)->orderBy('created_at','DESC')->limit(6)->get() : Course::where('status',1)->orderBy('created_at','DESC')->limit(6)->get();
        }

        return view('web.course.search',compact('courses'));
    }

    public function search(Request $request)
    {
        $number_course = $this->getConfigByKey('phan_trang_khoa_hoc')->value;
        $courses = Course::Where('name', 'like', '%' .$request->course. '%')->where('status',1)->orderBy('id', 'DESC')->paginate($number_course);
        $key_course = $request->course;
        $professions = Profession::where('status',1)->get();
        return view('web.course.index',compact('courses','professions','key_course'));
    }

    public function courseFree()
    {
        $number_course = $this->getConfigByKey('phan_trang_khoa_hoc')->value;
        $courses = Course::where(function($query){
            return $query->where('price', 0)->orWhere(function($query){
                return $query->where('price_sale', 0)->where('time_sale', '>=', \Carbon\Carbon::now());
            })->orWhere(function($query){
                return $query->where('price_sale', 0)->where('time_sale', null);
            });
        })->where('status',1)->paginate($number_course);
        $professions = Profession::where('status',1)->get();
        return view('web.course.index',compact('courses','professions'));
    }

    public function feedback(Request $request, Course $course){
        // validate content field of request
        $request->validate([
            'content' => 'required',
        ],[
            'content.required' => 'Bạn chưa nêu cảm nhận về khóa học'
        ]);

        // save feedback information of student
        $feedback = $request->only('content');
        $feedback['name'] = '';
        $feedback['avatar'] = '';
        $feedback['position'] = 'hoc viên';
        $feedback['position_type'] = 1;
        $feedback['course_id'] = $course->id;
        $feedback['user_id'] = auth('user')->user()->id;
        $feedback['star'] = (!isset($request->star)) ? 5 : $request->star;
        $feedback['status'] = 0;
        Feedback::create($feedback);

        return back()->with('success', 'Đánh giá thành công');
    }

    public function selectExpert($course_slug)
    {
        $course = Course::where('slug',$course_slug)->first();
        $experts = Expert::where('profession_id',$course->profession_id)
            ->whereHas('customer',function (Builder $query){
                $query->where('status','2');
            })->get();
        return view('web.course.select',compact('experts', 'course'));
    }

    public function saveSelectedExpert(Course $course,Expert $expert){
        $userCustomer['user_id'] = customer()->user()->id;
        $userCustomer['customer_id'] = $expert->customer_id;
        $userCustomer['course_id'] = $course->id;
        $userCustomer['confirm_time'] = \Carbon\Carbon::now()->toDateTimeString();
        $userCustomer['status'] = 2;
        $userCustomer['type'] = 0;
        UserCustomer::create($userCustomer);
        return redirect()->route('w.learn.index',$course->slug);
    }
}
