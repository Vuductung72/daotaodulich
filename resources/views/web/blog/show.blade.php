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
                <h2 class="blog-detail-title">{{ ucfirst($blog->name) }}</h2>
                <div class="blog-detail-meta">
                    <a class="blog-detail-post-date"><i class="fa-regular fa-calendar-days"></i>{{ \Carbon\Carbon::createFromDate($blog->created_at)->format('d/m/Y') }}</a>
                    {{-- <a class="blog-detail-post-views" href="#"><i class="fa-regular fa-eye"></i> 290 Views</a> --}}
                </div>
                <img class="blog-detail-img w-100" src="{{ asset($blog->image) }}" alt="Image">
                {!! $blog->content ?  $blog->content : 'Nội dung bài viết đang được cập nhật'!!}
                {{-- <div class="blog-detail-tag-social">
                    <div class="blog-detail-tag">
                        @if ($blog->keyword)
                            <a class="tag-item"><i class="fa-regular fa-circle-xmark"></i>{{ $blog->keyword }} </a>                            
                        @endif
                    </div>
                </div> --}}
            </div>
            <div class="row mb-n6 post-border-items">
                <h3 class="blog_relateds-title">Bài viết liên quan</h3> 
                @foreach ($blog_relateds as $blog_related)
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-6 link">
                        <!--== Start Blog Item ==-->
                        <div class="post-item">
                            <a href="{{route('w.blog.show',['category_slug' => $blog_related->category->slug,'blog_slug' => $blog_related->slug])}}" class="post-item-thumb">
                                <img class="w-100" src="{{ asset($blog_related->image) }}" width="370" height="244" alt="Image-HasTech">
                            </a>
                            <div class="post-item-content">
                                <div class="post-item-meta">
                                    <div class="post-item-date"><i class="fa-regular fa-calendar-days"></i>{{ \Carbon\Carbon::createFromDate($blog_related->created_at)->format('d/m/Y') }}</div>
                                    {{-- <div class="post-item-views"><i class="fa-regular fa-eye"></i> 290 Views</div> --}}
                                </div>
                                <h4 class="post-item-title"><a href="{{route('w.blog.show',['category_slug' => $blog_related->category->slug,'blog_slug' => $blog_related->slug])}}">{{ $blog_related->name }}</a></h4>
                                {{-- <p class="post-item-desc">{{ $blog_related->description }}</p> --}}
                                <a class="btn-link" href="{{route('w.blog.show',['category_slug' => $blog_related->category->slug,'blog_slug' => $blog_related->slug])}}">Đọc thêm <i class="icon fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <!--== End Blog Item ==-->
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--== End Blog Detail Area Wrapper ==-->

@endsection
