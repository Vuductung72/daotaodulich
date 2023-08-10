<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCmsRequest;
use App\Http\Requests\Admin\UpdateCmsRequest;
use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CmsController extends Controller
{
    public function index(Request $request)
    {
        $query = Cms::orderBy('id', 'DESC');

        if ( $request->name ) {
            $query->where('cms.name', 'LIKE', '%' . $request->name . '%');
        }

        $cms = $query->paginate();

        return view('admin.cms.index', compact('cms'));
    }

    public function create()
    {
        return view('admin.cms.create');
    }

    public function store(CreateCmsRequest $request)
    {
        $data = $request->only('name', 'content', 'description', 'keywords');
        $data['image'] = $this->uploadFile($request->image);
        $data['slug'] = Str::slug($request->name);

        Cms::create($data);
        session()->flash('success', 'Thành Công');

        return redirect()->route('ad.cms.index');
    }

    public function edit($cms)
    {
        $cms = Cms::find($cms);
        return view('admin.cms.edit', compact('cms'));
    }

    public function update(UpdateCmsRequest $request, $cms)
    {
        $data = $request->only('name', 'description', 'content', 'keywords');

        if ($request->image) {
            $request->validate([
                'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5120'
            ]);

            $path = $this->uploadFile($request->image);
            $data['image'] = $path;
        }

        $data['slug'] = Str::slug($request->name);
        $cms = Cms::find($cms);
        $cms->update($data);

        session()->flash('success', 'Thành công');

        return redirect()->route('ad.cms.index');
    }

    public function destroy($cms)
    {
        Cms::find($cms)->delete();
        session()->flash('success', 'Thành Công!');
        return redirect()->route('ad.cms.index');
    }
}
