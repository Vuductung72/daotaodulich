<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\CreateLessonRequest;
use App\Http\Requests\Admin\UpdateLessonRequest;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\LessonQuestion;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
class LessonController extends Controller
{
    // convert text to speech
    // protected function conversionText($text){
    //     $textToSpeechClient = new TextToSpeechClient();
    //     $input = new SynthesisInput();
    //     $input->setText($text);
    //     $voice = new VoiceSelectionParams();
    //     $voice->setLanguageCode('vi-VN');
    //     $audioConfig = new AudioConfig();
    //     $audioConfig->setAudioEncoding(AudioEncoding::MP3);
    //     $resp = $textToSpeechClient->synthesizeSpeech($input, $voice, $audioConfig);
    //     $time = date('sihdmy');
    //     $file_audio = '/storage/mp3/audio-'.$time.'.mp3';
    //     return ['check_file' => file_put_contents("./$file_audio", $resp->getAudioContent()), 'file_path' => $file_audio];
    // }

    /**
     * Display a listing of the lesson
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::orderBy('id','DESC')->paginate(15);
        return view('admin.lessons.index',compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::where('status',1)->get();
        return view('admin.lessons.create',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLessonRequest $request)
    {
        $new_lesson = $request->only('name','order','content','course_id');
        $new_lesson['slug'] = Str::slug($request->name,'-');
        $new_lesson['thumb'] =  $request->has('thumb') ? $this->uploadFile($request->thumb) : '/images/no_image.png';
        $new_lesson['audio'] = $request->has('audio') ? $this->uploadAudio($request->audio) : null;
        Lesson::create($new_lesson);
        return redirect()->route('ad.lesson.index')->with('success','Thêm bài học thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        $lesson_questions = LessonQuestion::where('lesson_id',$lesson->id)->get();
        session()->put('lesson_questions', $lesson_questions->toArray());
        return view('admin.lessons.show',compact('lesson_questions','lesson'));
    }

    public function search(Request $request)
    {
        $lessons = Lesson::Where('name', 'like', '%' .$request->lesson. '%')->orderBy('course_id', 'asc')->orderBy('order', 'asc')->paginate(7);
        return view('admin.lessons.index', compact('lessons'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        $courses = Course::where('status',1)->get();
        return view('admin.lessons.edit',compact('lesson','courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $update_lesson = $request->only('name','order','content','course_id');
        $update_lesson['slug'] = Str::slug($request->name,'-');
        if($request->has('thumb')) $update_lesson['thumb'] = $this->uploadFile($request->thumb);

        if($request->audio){
            // delete file audio already exists
            if(file_exists($lesson->audio)) unlink($lesson->audio);
            $update_lesson['audio'] = $this->uploadAudio($request->audio);

            // create file audio new
            // $result = $this->conversionText($request->audio);
            // if($result['check_file']) $update_lesson['audio'] =  $result['file_path'];
        }

        $lesson->update($update_lesson);
        return redirect()->route('ad.lesson.index')->with('success','Cập nhật bài học thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lesson::destroy($id);
        return redirect()->route('ad.lesson.index')->with('success', 'Xóa thành công');
    }

    public function updateStatus(Lesson $lesson){
        if($lesson->status === 0){
            $lesson->status = 1;
        }else{
            $lesson->status = 0;
        }
        $lesson->save();
        return back()->with('success','Cập nhật thành công');
    }
}
