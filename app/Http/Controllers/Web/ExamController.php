<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Question;
use App\Models\ExamQuestion;
use App\Models\Exam;
use App\Models\Profession;
use App\Models\Result;
use Illuminate\Contracts\Session\Session;

class ExamController extends Controller
{
    /**
     * Show info of exam
     * @return \Illuminate\Http\Response
     */
    public function exam($course_slug)
    {
        $course = Course::where('slug',$course_slug)->first();
        // $exam = Exam::find(9);
        $results = Result::where('user_id',customer()->user()->id)->where('type',1)-> where('status',1)->where('course_id', $course->id)->first();
        // dd($results);

        if($results == null){
            $exam = $course->exams()->inRandomOrder()->first();

            $user = auth('user')->user();
            // dd($exam->id);

            // Check if the exam paper exists or if there is a question
            if(!$exam OR !$exam->examQuestions->count()) return redirect()->back()->with('info', 'Đề thi đang cập nhật');

            // Deduct money when taking the exam from the 2nd time
            if(Result::where('user_id',$user->id)->where('type',1)->where('exam_id',$exam->id)->count() > 0){
                if($user->money >= $exam->money){
                    $user->money = $user->money - $exam->money;
                    $user->save();
                }else{
                    return back()->with('info','Tài khoản của bạn không đủ tiền để thi lại! Vui lòng nạp thêm tiền để thi.');
                }
            }

            $list_question = $exam ? $exam->examQuestions->pluck('question_id') : null;
            return view('web.exam.index',compact('list_question','exam','course'));
        }
        else{
            return redirect()->route('w.exam.history')->with('info', 'Bạn đã hoàn thành bài thi của khóa học này!');
        }
    }

    /**
     * to examine
     */
    public function mark(Request $request,Course $course , $exam_id)
    {
        // dd(Result::where('user_id',customer()->user()->id)->where('type',1)-> where('status',1)->where('course_id', $course->id)->first());
        $results = Result::where('user_id',customer()->user()->id)->where('type',1)-> where('status',1)->where('course_id', $course->id)->first();
        if($results == null){
            $exam = Exam::find($exam_id);

            // $course = Course::where('slug',$course_slug)->first();
            // get info of question and answer
            $exam_question = ExamQuestion::where('exam_id',$exam_id)->count();
            // get info answer from form
            $results = $request->except(['_token']);
            // compare answer of form with database
            $right_sentence = 0;
            // $answer_wrong_list = array(1,2);
            $exam_result['answer'] = array();

            foreach($results as $key => $result){
                // get answers of question
                $true_answers = Question::find($key)->answers->where('status',1);
                // compare right answer of form with database
                if(count($result) === $true_answers->count()){
                    if(!empty(array_diff($true_answers->pluck('id')->toArray(),$result))){
                        $exam_result['answer'][$key] = 0;
                        continue;
                    }
                    else{
                        $exam_result['answer'][$key] = 1;
                        $right_sentence ++;
                    }
                }else{
                    $exam_result['answer'][$key] = 0;
                }
            }

            // save result exam
            $number_pass = Exam::find($exam_id)->number_pass;
            $point =  intval($right_sentence/$exam_question*100);
            $exam_result['user_id'] = auth('user')->user()->id;
            $exam_result['exam_id'] = $exam_id;
            $exam_result['course_id'] = $course->id;
            $exam_result['point'] = $point;
            $exam_result['status'] = ($right_sentence < $number_pass) ? 0 : 1;
            $exam_result['type'] = 1;
            $exam_result['answer'] = json_encode($exam_result['answer']);
            $result = Result::create($exam_result);
            if($right_sentence < $number_pass){
                return redirect()->route('w.exam.history')->with('notification',"Kết quả bài thi của bạn đúng: $right_sentence/$exam_question câu!");
            }
            else{
                $profession = Profession::where('slug',$exam->profession->slug)->first();
                $link = route('w.internship.search_by_profession', $profession->slug);
                session()->flash('link', $link);
                return redirect()->route('w.exam.history')->with('complete',"Kết quả bài thi của bạn đúng: $right_sentence/$exam_question câu!");
            }
        }
        else{
            return redirect()->route('w.exam.history')->with('info',"Bạn đã hoàn thành bài thi của khóa học này!");
        }
    }


    /* thi thu */
    public function auditions(Request $request, Course $course , $exam_id)
    {
        $exam = Exam::find($exam_id);
        // get info of question and answer
        $exam_question = ExamQuestion::where('exam_id',$exam_id)->count();
        // get info answer from form
        $results = $request->except(['_token']);
        // compare answer of form with database
        $right_sentence = 0;
        // $answer_wrong_list = array(1,2);
        $exam_result['answer'] = array();

        foreach($results as $key => $result){
            // get answers of question
            $true_answers = Question::find($key)->answers->where('status',1);
            // compare right answer of form with database
            if(count($result) === $true_answers->count()){
                if(!empty(array_diff($true_answers->pluck('id')->toArray(),$result))){
                    $exam_result['answer'][$key] = 0;
                    continue;
                }
                else{
                    $exam_result['answer'][$key] = 1;
                    $right_sentence ++;
                }

            }else{
                $exam_result['answer'][$key] = 0;
            }
        }

        // save result exam
        $number_pass = Exam::find($exam_id)->number_pass;
        $point =  intval($right_sentence/$exam_question*100);
        $exam_result['user_id'] = auth('user')->user()->id;
        $exam_result['exam_id'] = $exam_id;
        $exam_result['course_id'] = $course->id;
        $exam_result['point'] = $point;
        $exam_result['status'] = ($right_sentence < $number_pass) ? 0 : 1;
        $exam_result['type'] = 0;
        $exam_result['answer'] = json_encode($exam_result['answer']);

        Result::create($exam_result);

        return redirect()->route('w.exam.history')->with('info',"Kết quả bài thi của bạn là: $right_sentence/$exam_question câu!");
    }

    public function question($question_id)
    {
        $question= Question::find($question_id) ?? null;
        return ($question) ? [$question, $question->answers ] : [];
    }

    public function test($course_slug)
    {
        $course = Course::where('slug',$course_slug)->first();
        $exam = $course->examTest;

        // check test exam or question exists
        if(!$exam OR !$exam->examQuestions->count()) return redirect()->back()->with('info', 'Đề thi thử đang cập nhật');

        // check customer has taken  the test exam
        if(Result::where('user_id',auth('user')->user()->id)->where('exam_id',$exam->id)->where('type',0)->count()) return redirect()->back()->with('info', 'Bạn chỉ được tham gia thi thử được 1 lần!');

        // get list question for test exam
        $list_question = $exam ? $exam->examQuestions->pluck('question_id') : null;

        return view('web.exam.auditions',compact('list_question','exam','course'));
    }

    public function history()
    {
        $historys = Result::where('user_id',customer()->user()->id)->orderBy('id','DESC')->get();
        return view('web.exam.history',compact('historys'));
    }

    public function result(Result $history){
        $answer = json_decode($history->answer, true);
        return view('web.exam.results',compact('answer'));
    }
}
