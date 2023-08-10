@extends('web.layouts.master')
@section('page_title', $blog->name)
@section('page_keywords', $blog->keyword)
@section('page_description', $blog->description)
@section('page_og:image',asset($blog->image))
@section('content')
    <!--== Start Blog Detail Area Wrapper ==-->
    <div class="blog-detail-area section-space">
        <div class="container">
            <div class="blog-detail">
                {!! $blog->content ?  $blog->content : 'Nội dung bài viết đang được cập nhật'!!}
            </div>
        </div>
    </div>
    <!--== End Blog Detail Area Wrapper ==-->

@endsection
