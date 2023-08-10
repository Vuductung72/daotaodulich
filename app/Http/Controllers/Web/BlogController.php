<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $number_blog = $this->getConfigByKey('phan_trang_bai_viet')->value;
        $blog_news = clone ($blogs =  Blog::where('status',1)->orderBy('id','DESC')->whereHas('category', function( $query){
            $query->where('type', 0)->where('status', 1);
        }));
        $blog_news = $blog_news->limit(6)->get();

        // get all blogs
        $blogs = $blogs->limit($number_blog + 6)->get()->diff($blog_news);
        // dd($blogs);

        // get blogs outstanding
        $blog_outstanding = $blog_news->first();

        // get blogs news
        $blog_news->shift(); 

        return view('web.blog.index',compact('blogs','blog_news','blog_outstanding'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category_slug, $blog_slug)
    {
        $blog = Blog::where('slug',$blog_slug)->first();
        $blog_relateds = Blog::where('category_id',$blog->category->id)->whereNotIn('slug',[$blog_slug])->orderBy('id','DESC')->limit(3)->get();
        return view('web.blog.show',compact('blog','blog_relateds'));
    }

    public function getByCategorySlug(string $slug){
        $category = Category::where('slug',$slug)->first();
        $blogs = clone ($blog_news = $category ? $category->blogs() : abort(404));
        $blog_news = $blog_news->where('status',1)->orderBy('id','DESC')->limit(6)->get();

        // get all blogs
        $blogs = $blogs->where('status',1)->get()->diff($blog_news);

        // get blogs outstanding
        $blog_outstanding = $blog_news->first();

        // get blogs news
        $blog_news->shift();
    
        return view('web.blog.index',compact('blogs','blog_news','blog_outstanding','category'));
    }

    public function showTerm($blog_slug)
    {
        $blog = Blog::where('slug',$blog_slug)->where('type', 1)->first();
        return view('web.blog.term',compact('blog'));
    }
}
