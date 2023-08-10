<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateQuestionRequest;
use App\Http\Requests\Admin\UpdateQuestionRequest;
use App\Models\Question;
use App\Models\ExamQuestion;
use App\Models\LessonQuestion;
use App\Models\Profession;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professions = Profession::all();
        $questions = Question::paginate(10);
        return view('admin.questions.index',compact('questions','professions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $professions = Profession::all();
        if(!$professions->count()) return redirect()->back()->with('info', 'Chưa có ngành nghề nào. Bạn cần thêm ngành nghề để có thể tạo câu hỏi');
        return view('admin.questions.create',compact('professions'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionRequest $request)
    {
        $newQuestion = $request->only('name','content','type','profession_id');
        if(!Question::create($newQuestion)){
            return redirect()->back()->with('error', 'Thêm câu hỏi thất bại');
        }
        return redirect()->route('ad.question.index')->with('success', 'Thêm câu hỏi thành công');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $answers = Answer::where('question_id', $question->id)->get();
        return view('admin.questions.show',compact('question','answers'));
    }

    public function answer(Question $question,Request $request)
    {
        if(!$request->id){
            return redirect()->back()->with('info', 'Bạn chưa nhập câu trả lời');
        }

        for ($i = 0; $i < count($request->id); $i++){
            // check if the question already exists 
            if($request->id[$i] == null){
                $newAnswer['name'] = $request->name[$i] ? $request->name[$i] : '';
                $newAnswer['question_id'] = $question->id;
                $newAnswer['status'] = $request->status[$i];
                Answer::create($newAnswer);
            }else{
                $newAnswer['name'] = $request->name[$i];
                $newAnswer['question_id'] = $question->id;
                $newAnswer['status'] = $request->status[$i];
                $answer = Answer::find($request->id[$i]);
                $answer->update($newAnswer);
            }
        };

        return redirect()->route('ad.question.show',$question)->with('success', 'Cập nhật câu trả lời thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $professions = Profession::all();
        if($request->profession_id === '0'){
            $questions = Question::paginate(10);
        }else{
            $questions = Question::Where('profession_id', $request->profession_id)->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        }
        return view('admin.questions.index', compact('questions','professions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $professions = Profession::all();
        return view('admin.questions.edit',compact('question','professions'));           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request,Question $question)
    {
        $updateQuestion = $request->only('name','content','type','profession_id');
        if(!$question->update($updateQuestion)){
            return redirect()->back()->with('error', 'Chỉnh sửa câu hỏi thất bại');
        }
        return redirect()->route('ad.question.index')->with('success', 'Chỉnh sửa câu hỏi thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // dd($question->examQuestions->count());
        if($question->examQuestions->count() > 0 OR $question->lessonQuestions->count() > 0) return back()->with('info','Không thể xóa vì câu hỏi đã có trong bài học, đề thi');
        Answer::where('question_id',$question->id)->delete();
        ExamQuestion::where('question_id',$question->id)->delete();
        LessonQuestion::where('question_id',$question->id)->delete();
        Question::destroy($question->id);
        return redirect()->route('ad.question.index')->with('success', 'Xóa câu hỏi thành công');
    }

    public function updateStatus(Question $question)
    {
        if($question->status === 0){
            $question->status = 1;
        }else{
            $question->status = 0;
        }

        $question->save();
        return back()->with('success','Cập nhật thành công');
    }

    public function exportQuestion(Request $request){
        if($request->profession_id === '0'){
            $questions = Question::all();
        }else{
            $questions = Question::Where('profession_id', $request->profession_id)->orderBy('id', 'DESC')->get();
        }
        $export = new \App\Exports\QuestionsExport($questions);
        return  Excel::download($export, 'danh_sach_cau_hoi_'.date('d-m-Y').'.xlsx');
    }
}
