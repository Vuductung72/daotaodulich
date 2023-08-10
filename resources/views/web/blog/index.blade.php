@extends('web.layouts.master')
@section('page_title', 'Tin tức '.((isset($category)) ?  ucfirst($category->name) : '') )
@section('page_keywords',config('constant.page_keywords_category'))
@section('page_description', ((isset($category)) ?  ucfirst($category->description) : config('constant.page_description_category')))
@section('page_og:image', ((isset($category)) ?  ucfirst($category->image) : config('constant.page_images_category')))
@section('content')
<section id="page-blog">
    <div class="container">
        <div class="row">
            @if ( isset($blog_outstanding) && $blog_outstanding != null)
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-12">
                            @if (request()->is(['danh-sach-bai-viet']))
                                <h2 class="title"> Tin tức </h2>                                
                            @else
                                <h2 class="title"> {{ ucfirst($blog_outstanding->category->name) }} </h2>                                
                            @endif
                        </div>
                        @if ($blog_outstanding)
                            <div class="col-12">
                                <div class="blog-first">
                                    <a href="{{route('w.blog.show',['category_slug' => $blog_outstanding->category->slug,'blog_slug' => $blog_outstanding->slug])}}">
                                        <div class="box-images">
                                            <img src="{{ asset($blog_outstanding->image) }}" alt="">
                                        </div>
                                        <div class="box-text text-left">
                                            <div class="count">
                                                <div class="post-date"><i class="fa-regular fa-calendar-days"></i>
                                                    {{ \Carbon\Carbon::createFromDate($blog_outstanding->created_at)->format('d/m/Y') }}</div>
                                                {{-- <div class="post-view"><i class="fa-solid fa-eye"></i> 1.200 lượt xem</div> --}}
                                            </div>
                                            <h3 class="post-title">{{$blog_outstanding->name}}</h3>
                                            <p class="desc">{{$blog_outstanding->description}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>                        
                        @endif
                        <div class="space"></div>
                        @if ($blogs->count(0))
                            @foreach ($blogs as $blog)
                                <div class="col-md-6 col-12">
                                    <a href="{{route('w.blog.show',['category_slug' => $blog->category->slug,'blog_slug' => $blog->slug])}}">
                                        <div class="blog-post">
                                            <div class="box-images">
                                                <img src="{{ asset($blog->image) }}" alt="">
                                            </div>
                                            <div class="box-text text-left">
                                                <div class="count">
                                                    <div class="post-date"><i class="fa-regular fa-calendar-days"></i> {{ \Carbon\Carbon::createFromDate($blog->created_at)->format('d/m/Y') }}
                                                    </div>
                                                    {{-- <div class="post-view"><i class="fa-solid fa-eye"></i> 1.200 lượt xem</div> --}}
                                                </div>
                                                <h3 class="post-title">{{ $blog->name }}</h3>
                                                {{-- <p class="desc">{{ $blog->description }}</p> --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach                        
                        @endif
                    </div>
                </div>
                @if ($blog_news->count())
                    <div class="col-md-4">
                        <div class="sidebar-post">
                            {{-- bai viet moi nhat --}}
                            <h2 class="title"> Bài viết mới nhất </h2>
                            <div class="row">
                                <div class="col-12">
                                    @foreach ($blog_news as $blog_new)
                                        <div class="vec-blog">
                                            <div class="box-images">  
                                                <a href="{{route('w.blog.show',['category_slug' => $blog_new->category->slug,'blog_slug' => $blog_new->slug])}}">                  
                                                    <img src="{{ asset($blog_new->image) }}" alt="">
                                                </a>
                                            </div>  
                                            <div class="box-text">
                                                <h4 class="post-title"><a href="{{route('w.blog.show',['category_slug' => $blog_new->category->slug,'blog_slug' => $blog_new->slug])}}">{{ $blog_new->name }}</a></h4>
                                                <div class="post-date"><i class="fa-regular fa-calendar-days"></i> {{ \Carbon\Carbon::createFromDate($blog_new->created_at)->format('d/m/Y') }}
                                            </div>
                                            </div>
                                        </div>                                
                                    @endforeach
                                </div>
                            </div>
                            <div class="space"></div>
                        </div>              
                    </div>                
                @endif          
            @else
                @include('web.components.alert_text',['text_alert' =>'Các bài viết đang được cập nhật'])
            @endif
        </div> 
    </div>
</section>
@endsection