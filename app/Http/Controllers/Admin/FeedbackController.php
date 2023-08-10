<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateFeedbackRequest;
use App\Http\Requests\Admin\UpdateFeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::orderBy('id', 'ASC')->get();
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.feedbacks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFeedbackRequest $request)
    {
        try {
            $data = $request->only('name', 'position', 'position_display', 'position_type', 'content', 'status');
            $data['avatar'] = $this->uploadFile($request->avatar);
            $data['star'] = 5;
            Feedback::create($data);

            session()->flash('success', 'Thành công');
            return redirect()->route('ad.feedback.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Thất bại');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        return view('admin.feedbacks.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        try {
            if($feedback->user_id > 0){
                $data['avatar'] = $request->only('content');
            }{
                $data = $request->only('name', 'position', 'position_display', 'position_type', 'content', 'status');
                if ($request->avatar) {
                    $path = $this->uploadFile($request->avatar);
                    $data['avatar'] = $path;
                }
            }
            $feedback->update($data);
            session()->flash('success', 'Thành công');
            return redirect()->route('ad.feedback.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Thất bại');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        session()->flash('success', 'Thành công');
        return redirect()->route('ad.feedback.index');
    }

    public function status(Feedback $feedback)
    {
        if($feedback->status == 1){
            $feedback->update(['status'=> 0]);
        }else{
            $feedback->update(['status'=> 1]);
        }
        
        return back()->with('success','Cập nhật thành công!');
    }
}
