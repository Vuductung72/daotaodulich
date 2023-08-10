<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\LessonQuestion;
use App\Models\Question;
use App\Models\Learned;
use App\Models\Result;

class LearnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $course = Course::where('slug',$slug)->first();
        $allowExam = $this->checkExam($course);
        $lessons = Lesson::where(['course_id' => $course->id, 'status' => 1])->get();

        // get info of lesson learned
        $lesson = Lesson::where(['course_id' => $course->id, 'status' => 1])->orderBy('order','DESC')->whereHas('learneds',function( $query){
            $query->where('user_id', customer()->user()->id);
        })->first();

        // get previous lesson
        if($lesson){
            $previous_lesson = ($lesson->order > 1) ? $course->lessons()->where('order','<',$lesson->order)->where('status', 1)->orderBy('order','DESC')->first() : '';
        }else{
            $previous_lesson = '';
            // get info of lesson if customer have not learn lesson
            $lesson = Lesson::where(['course_id'=> $course->id, 'status' => 1])->orderBy('order','ASC')->first();
        }

        $next_lesson = $lesson ? $lessons->where('order','>',$lesson->order)->first() : null;

        // get count the lesson learned
        if($lesson){
            $countLearned = Learned::where(['user_id' => customer()->user()->id, 'lesson_id' => $lesson->id,'course_id' => $course->id])->get()->count();
        }else{
            $countLearned = 0;
        }

        // check if the user has taken the exam
        $exam_success = Result::where(['user_id' => customer()->user()->id, 'course_id' => $course->id, 'status' => 1, 'type' => 1 ])->count();
        $examed = Result::where(['user_id' => customer()->user()->id, 'course_id' => $course->id, 'type' => 1 ])->count();

        return view('web.learn.index',compact('course','lessons','lesson','next_lesson','previous_lesson','exam_success','examed','allowExam','countLearned'));
    }

    public function preShow($course_slug,$lesson_slug){
        $course = Course::where('slug',$course_slug)->first();

        // get info lesson and all lessons of course
        $lesson = Lesson::where('slug',$lesson_slug)->first();
        $lesson = $course->lessons()->where('order','<',$lesson->order)->where('status', 1)->orderBy('order','DESC')->first();
        $lessons = Lesson::where(['course_id' => $course->id, 'status' => 1])->get();

        // get info previous and next lesson
        if($lesson){
            $previous_lesson = ($lesson->order > 1) ? $course->lessons()->where('status', 1)->where('order','<',$lesson->order)->orderBy('order','DESC')->first() : '';
        }else{
            $previous_lesson = '';
        }
        $next_lesson = $lesson ?? null;

        // get count the lesson learned
        $countLearned = Learned::where(['user_id' => customer()->user()->id, 'lesson_id' => $next_lesson->id,'course_id' => $course->id])->get()->count();

        // check if the cusotmer can take the exam
        $allowExam = $this->checkExam($course);

        // check if the user has taken the exam
        $exam_success = Result::where(['user_id' => customer()->user()->id,'course_id' => $course->id,'status' => 1, 'type' => 1 ])->count();
        $examed = Result::where(['user_id' => customer()->user()->id,'course_id' => $course->id, 'type' => 1 ])->count();

        return view('web.learn.index',compact('exam_success','examed','course','lessons','lesson','previous_lesson','next_lesson','allowExam','countLearned'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function nextShow($course_slug,$lesson_slug){
        $course = Course::where('slug',$course_slug)->first();
        $lesson = Lesson::where('course_id', $course->id)->where('slug',$lesson_slug)->first();

        // check lesson passed
        $quantityQuestion = LessonQuestion::where('lesson_id',$lesson->id)->get()->count();
        $isLearned  = Learned::where(['user_id' => customer()->user()->id,'lesson_id' => $lesson->id, 'course_id' => $course->id])->get()->count();
        if($quantityQuestion == 0){
            // case lesson not available question
            if(!$isLearned){
                // save info pass lesson
                $learn['user_id'] = customer()->user()->id;
                $learn['lesson_id'] = $lesson->id;
                $learn['course_id'] = $lesson->course_id;
                Learned::create($learn);
            }
        }else{
            // case lesson have question
            if(!$isLearned){
                return back()->with('info','Bạn cần hoàn thành câu hỏi ôn tập để học bài tiếp theo');
            }
        }

        // get info lesson and all lessons of course
        $lessons = Lesson::where(['course_id' => $course->id, 'status' => 1])->get();
        $lesson = $lessons->where('order','>',$lesson->order)->first();

        // get info previous and next lesson
        if($lesson){
            $previous_lesson = ($lesson->order > 1) ? $course->lessons()->orderBy('order','DESC')->where('order','<',$lesson->order)->first() : '';
        }else{
            $previous_lesson = '';
        }
        $next_lesson = $lesson ? $lessons->where('order','>',$lesson->order)->first() : null;

        // get count the lesson learned
        $countLearned = Learned::where(['user_id' => customer()->user()->id, 'lesson_id' => $lesson->id, 'course_id' => $course->id])->get()->count();

        // check if the cusotmer can take the exam
        $allowExam = $this->checkExam($course);

        // check if the user has taken the exam
        $exam_success = Result::where(['user_id' => customer()->user()->id,'course_id' => $course->id,'status' => 1, 'type' => 1 ])->count();
        $examed = Result::where(['user_id' => customer()->user()->id,'course_id' => $course->id, 'type' => 1 ])->count();

        return view('web.learn.index',compact('exam_success','examed','course','lessons','lesson','previous_lesson','next_lesson','allowExam','countLearned'));
    }

    public function reviewGrade(Request $request,Lesson $lesson){
        $results = $request->except(['_token']);
        // check student selected answer
        if($results === []) return back()->with('info','Bạn vui lòng chọn đáp án!');

        // check answer of student
        foreach($results as $key => $result){

            // get answers of question
            $true_answers = Question::find($key)->answers->where('status',1);

            // compare right answer of form with database
            if(count($result) === $true_answers->count()){
                if(!empty(array_diff($true_answers->pluck('id')->toArray(),$result))){
                    return back()->with('info','Đáp án trả lời của bạn chưa chính xác');
                }
            }else{
                return back()->with('info','Đáp án trả lời của bạn chưa chính xác');
            }
        }

        // check history review grade of student if not, save it
        $countLesson = Learned::where(['lesson_id' => $lesson->id, 'course_id' => $lesson->course_id,'user_id' => customer()->user()->id])->get()->count();
        if($countLesson == 0){
            $learn['user_id'] = customer()->user()->id;
            $learn['lesson_id'] = $lesson->id;
            $learn['course_id'] = $lesson->course_id;
            Learned::create($learn);
        }

        return back()->with('info','Chúc mừng bạn đã hoàn thành câu hỏi ôn tập của bài');
    }

    public function checkExam($course){
        // check if the user already has a course certificate
        $result = CourseUser::where(['user_id' => customer()->user()->id, 'course_id' => $course->id, 'status' => 1])->count();
        if($result) return $result;

        // check if the user has completed the lessons
        $lastLesson = Lesson::where(['course_id' => $course->id,'status' => 1])->orderBy('order','DESC')->first();
        $result = $lastLesson ? Learned::where(['user_id' => customer()->user()->id,'course_id' => $course->id, 'lesson_id' => $lastLesson->id])->get()->count() : 0;
        return $result;
    }
}
