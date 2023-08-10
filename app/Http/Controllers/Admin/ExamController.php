<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ExamRequest;
use App\Models\Result;
use App\Models\Course;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::paginate(20);
        return view('admin.exams.index',compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $professions = Profession::all();
        $courses = Course::all();
        if(!$professions->count()) return redirect()->back()->with('info', 'Chưa có ngành nghề nào. Bạn cần thêm ngành nghề để có thể tạo bộ đề thi');
        return view('admin.exams.create',compact('professions', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        $new_exam = $request->only('name', 'profession_id','course_id', 'time', 'money','type','number_pass');
        // create exam
        if($request->number_pass > $request->number) return redirect()->back()->with('warning', 'Số câu bắt buộc đúng phải nhỏ hơn hoặc bằng số câu');
        if(!$exam = Exam::create($new_exam)){
            return redirect()->back()->with('error', 'Thêm bộ đề thi thất bại');
        }
        // create question for exam
        $exam_id = $exam->id;
        $number_of_sentences = $request->number;
        $count_question = Question::where('profession_id', $request->profession_id)->where('type',1)->count();
        $questions = Question::where('profession_id', $request->profession_id)->where('type',1)->get('id')->toArray();
        // check question of profession
        if(!($number_of_sentences <= $count_question)){
            Exam::destroy($exam_id);
            return back()->with('info', 'Số lượng câu hỏi trong ngân hàng câu hỏi không đủ để tạo đề thi');
        }
        // create question_id for exam_question
        $list_question_id_random = Arr::random($questions,$number_of_sentences);
        foreach($list_question_id_random as $key => $value){
            $list_question_random[$key]['exam_id'] = $exam_id;
            $list_question_random[$key]['question_id'] = $value['id'];
        }
        // add question for exam
        if(!ExamQuestion::insert($list_question_random)){
            return redirect()->back()->with('error', 'Tạo câu hỏi cho bộ đề thi thất bại');
        }
        return redirect()->route('ad.exam.show',$exam)->with('success', 'Thêm bộ đề thi thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        $exam_questions = ExamQuestion::where('exam_id',$exam->id)->get();
        session()->put('exam_questions', $exam_questions->toArray());
        return view('admin.exams.show',compact('exam_questions','exam'));
    }

    public function search(Request $request)
    {
        $exams = Exam::Where('name', 'like', '%' .$request->name. '%')->orderBy('id', 'DESC')->paginate(20);
        return view('admin.exams.index', compact('exams'));
    }

    /**
     * add question for exam.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //  check xem ngành nghề đã có câu hỏi chưa
        if(!Question::where('profession_id', $exam->profession_id)->count()){
            return redirect()->back()->with('info', 'Không có câu hỏi phù hợp với đề thi');
        }
        // get the questions is not in the exam
        $exam_questions = session('exam_questions');
        $list_question_id = [];

        foreach ($exam_questions as $key => $value) {
            $list_question_id[$key] = $value['question_id'];
        }

        $list_question = Question::where(['profession_id' => $exam->profession_id, 'type' => 1, 'status' => 1])
                        ->whereNotIn('id',$list_question_id)
                        ->get();
        return view('admin.exams.edit',compact('list_question','exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // update question for exam
    public function update(Request $request, Exam $exam)
    {
        if($request->id == null) return redirect()->back()->with('error', 'Bạn chưa chọn câu hỏi để thêm vào bộ đề thi');

        foreach($request->id as $key => $value){
            $new_exam_questions[$key]['exam_id'] = $exam->id;
            $new_exam_questions[$key]['question_id'] = $value;
        }
        // insert new question for exam
        if(!ExamQuestion::insert($new_exam_questions)){
            return redirect()->back()->with('error', 'Thêm câu hỏi cho bộ đề thất bại');
        }
        return redirect()->route('ad.exam.show',$exam)->with('success', 'Thêm câu hỏi cho bộ đề thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list_examQuestion_id = ExamQuestion::where('exam_id', $id)->get('id')->toArray();
        // check exist question of exam
        if($list_examQuestion_id == []){
            goto delete_exam;
        }
        // delete all question related to the exam set
        if(!ExamQuestion::destroy($list_examQuestion_id)) {
            return redirect()->back()->with('error', 'Xóa bộ đề thất bại');
        }

        delete_exam:
        if(!Exam::destroy($id)){
            return redirect()->back()->with('error', 'Xóa bộ đề thất bại');
        }
        return redirect()->route('ad.exam.index')->with('success', 'Xóa bộ đề thành công');
    }
    // delete question from exam
    public function delete($id)
    {
        if(!ExamQuestion::destroy($id)){
            return redirect()->back()->with('error', 'Xóa câu hỏi của bộ đề thất bại');
        }
        return redirect()->back()->with('success', 'Xóa câu hỏi của bộ đề thành công');
    }

    public function updateStatus(Exam $exam)
    {
        if($exam->status === 0){
            $exam->status = 1;
            $exam->save();
        }else{
            $exam->status = 0;
            $exam->save();
        }

        return back()->with('success','Cập nhật thành công');
    }

    public function resultExam(){
        $results = Result::orderBy('id','DESC')->orderBy('id', 'desc')->paginate();
        return view('admin.result_exam',compact('results'));
    }

    public function exportResult(){
        $questions = Result::orderBy('id','DESC')->get();
        $export = new \App\Exports\ResultsExport($questions);
        return  Excel::download($export, 'danh_sach_ket_qua_thi_'.date('d_m_Y').'.xlsx');
    }
}
