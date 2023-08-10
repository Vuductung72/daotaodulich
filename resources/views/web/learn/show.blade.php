@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Danh sách bài học')
@section('content')

<section id="page-learning">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="sidebar-learning">
                    <div class="d-flex align-items-center">
                        <button class="btn-menu-learning "><i class="fa-solid fa-bars"></i></button>
                        <span class="ml-3 d-block d-md-none text-white title">Danh sách bài học</span>
                    </div>
                    <div id="overlay-learning"></div>
                    <div id="list-lesson">
                        <h2>Danh Sách Bài Học</h2>
                        <ul>
                            <li><a href="" class="active"></a></li>
                            <li><a href="">aaasdafafasgf</a></li>
                        </ul>
                    </div>                      
                </div>
            </div>
            <div class="col-md-9 col-12">
                <div class="main-learning">
                    <div id="mainLeaderboard"></div>
                    <h1 class="name-lesson">{{ $lesson->name}}</h1>
                    <div class="nextprev d-flex justify-content-between align-items-center">
                        <a href="" class="btn btn-prev"><i class="fa-solid fa-chevron-left"></i>bài trước</a>
                        <a href="" class="btn btn-next"> bài tiếp theo<i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                    <hr>
                    <div>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt commodi totam aliquid
                            accusamus velit quod est! Voluptas doloremque, facere minus temporibus, odio iusto
                            pariatur ducimus ratione voluptatibus assumenda tempore eaque.</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt commodi totam aliquid
                            accusamus velit quod est! Voluptas doloremque, facere minus temporibus, odio iusto
                            pariatur ducimus ratione voluptatibus assumenda tempore eaque.</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt commodi totam aliquid
                            accusamus velit quod est! Voluptas doloremque, facere minus temporibus, odio iusto
                            pariatur ducimus ratione voluptatibus assumenda tempore eaque.</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt commodi totam aliquid
                            accusamus velit quod est! Voluptas doloremque, facere minus temporibus, odio iusto
                            pariatur ducimus ratione voluptatibus assumenda tempore eaque.</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt commodi totam aliquid
                            accusamus velit quod est! Voluptas doloremque, facere minus temporibus, odio iusto
                            pariatur ducimus ratione voluptatibus assumenda tempore eaque.</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt commodi totam aliquid
                            accusamus velit quod est! Voluptas doloremque, facere minus temporibus, odio iusto
                            pariatur ducimus ratione voluptatibus assumenda tempore eaque.</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt commodi totam aliquid
                            accusamus velit quod est! Voluptas doloremque, facere minus temporibus, odio iusto
                            pariatur ducimus ratione voluptatibus assumenda tempore eaque.</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt commodi totam aliquid
                            accusamus velit quod est! Voluptas doloremque, facere minus temporibus, odio iusto
                            pariatur ducimus ratione voluptatibus assumenda tempore eaque.</p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt commodi totam aliquid
                            accusamus velit quod est! Voluptas doloremque, facere minus temporibus, odio iusto
                            pariatur ducimus ratione voluptatibus assumenda tempore eaque.</p>
                    </div>     
                    <hr>         
                    <a href="" class="btn btn-blue">Làm bài tập <i class="fa-sharp fa-solid fa-pen"></i></a>
                    <hr>
                    <div class="nextprev d-flex justify-content-between align-items-center mb-3">
                        <a href="" class="btn btn-prev"><i class="fa-solid fa-chevron-left"></i>bài trước</a>
                        <a href="" class="btn btn-next"> bài tiếp theo<i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
