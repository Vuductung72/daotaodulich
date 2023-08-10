<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('position', 'ASC')->paginate();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        try {
            $data = $request->only('name', 'description', 'position', 'type');
            $data['slug'] = Str::slug($request->name);
            if($request->image != null){ 
                $data['image'] = $this->uploadFile($request->image);
            }else{
                $data['image'] = asset('/images/no_image.png');
            }
            Category::create($data);

            session()->flash('success', 'Thành công');
            return redirect()->route('ad.category.index');
        } catch(Exception $e) {
            session()->flash('error', 'Thất bại');
            return redirect()->back();
        }
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->only('name', 'description', 'position', 'type');

        if ($request->image != null) {
            $request->validate([
                'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5120'
            ]);

            $path = $this->uploadFile($request->image);
            $data['image'] = $path;

        }
        $data['slug'] = Str::slug($request->name);
        $category->update($data);

        session()->flash('success', 'Thành công');
        return redirect()->route('ad.category.index');
    }

    public function destroy(Category $category)
    {
        $category->blogs()->delete();
        $category->delete();
        session()->flash('success', 'Thành Công');
        return redirect()->route('ad.category.index');
    }

    public function status(Category $category){
        if($category->status == 1){
            $category->update(['status'=> 0]);
            return back()->with('success','Ẩn danh mục thành công!');
        }else{
            $category->update(['status'=> 1]);
            return back()->with('success','Hiện danh mục thành công!');
        }
        
        
    }
}
