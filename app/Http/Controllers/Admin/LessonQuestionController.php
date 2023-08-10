<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\LessonQuestion;
use App\Models\Question;
class LessonQuestionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //  check xem ngành nghề đã có câu hỏi chưa
        if(!Question::where(['profession_id' =>  $lesson->course->profession_id])->count()){
            return redirect()->back()->with('info', 'Ngành chưa có câu hỏi nào trong ngân hàng câu hỏi');
        }
        // lấy ra những câu hỏi chưa có trong bài học
        $lesson_questions = session('lesson_questions');
        $list_question_id = [];
        foreach ($lesson_questions as $key => $value) {
            $list_question_id[$key] = $value['question_id'];
        }
        $list_question = Question::where(['profession_id' => $lesson->course->profession_id, 'type' => 0, 'status' => 1])
                        ->whereNotIn('id',$list_question_id)
                        ->get();
        return view('admin.lesson_questions.edit',compact('list_question','lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        if($request->id == null) return redirect()->back()->with('error', 'Bạn chưa chọn câu hỏi để thêm vào bài học'); 

        foreach($request->id as $key => $value){
            $new_lesson_questions[$key]['lesson_id'] = $lesson->id;
            $new_lesson_questions[$key]['question_id'] = $value;
        }
        // insert new question for exam 
        if(!LessonQuestion::insert($new_lesson_questions)){
            return redirect()->back()->with('error', 'Thêm câu hỏi cho bài học thất bại');                     
        }
        return redirect()->route('ad.lesson.show',$lesson)->with('success', 'Thêm câu hỏi cho bài học thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!LessonQuestion::destroy($id)){
            return redirect()->back()->with('error', 'Xóa câu hỏi của bài học thất bại');
        }
        return redirect()->back()->with('success', 'Xóa câu hỏi của bài học thành công');
    }
}
