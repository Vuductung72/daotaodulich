<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateSliderRequest;
use App\Http\Requests\Admin\UpdateSliderRequest;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    
    public function index()
    {
        $sliders = Slider::orderBy('position', 'ASC')->paginate();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(CreateSliderRequest $request)
    {
        try {
            $data = $request->only('name', 'position', 'type');
            $data['image'] = $this->uploadFile($request->image);
            if ($request->has('url')) $data['url'] = $request->url;
    
            Slider::create($data);

            session()->flash('success', 'Thành công');
            return redirect()->route('ad.slider.index');
        } catch(Exception $e) {
            session()->flash('error', 'Thất bại');
            return redirect()->back();
        }
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }
    
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $data = $request->only('name', 'position', 'type');
        if ($request->has('url')) $data['url'] = $request->url;

        if ($request->image) {
            $request->validate([
                'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120'
            ]);

            $path = $this->uploadFile($request->image);
            $data['image'] = $path;

        }

        $slider->update($data);
        session()->flash('success', 'Thành công');

        return redirect()->route('ad.slider.index');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();

        session()->flash('success', 'Thành công');
        return redirect()->route('ad.slider.index');
    }

    public function status(Slider $slider)
    {
        if($slider->type == 1){
            $slider->update(['type'=> 0]);
        }else{
            $slider->update(['type'=> 1]);
        }
        
        return back()->with('success','Cập nhật thành công!');
    }
}
