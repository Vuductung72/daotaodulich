@extends('web.layouts.master')
@section('page_title', 'Chuyên gia')
@section('page_keywords', config('constant.page_keywords_expert'))
@section('page_description', config('constant.page_description_expert'))
@section('page_og:image',asset(config('constant.page_images_expert')))
@section('content')
    <div id="page-expert">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3 col-md-4">
                    <div class="expert-sidebar">
                        <div class="d-flex align-items-center">
                            <button class="btn_menu-expert"><i class="fa-solid fa-bars"></i></button>
                            <span class="ml-3 d-block d-md-none text-white title">Ngành nghề</span>
                        </div>
                        <div id="grey_back"></div>
                        <div id="menu_expert">
                            <div class="by-industry">
                                <h4 class="title">NGÀNH NGHỀ</h4>
                                @foreach ($professions as $profession)
                                    <a href="{{route('w.expert.search_by_profession',$profession->slug)}}" class="d-flex align-items-center">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                        <h5 class="{{request()->is(['nganh-nghe/'.$profession->slug]) ? 'text-primary professionId' : ''}}" id="{{$profession->id}}">{{$profession->name}}</h5>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9 col-md-8">
                    <div class="row show-product">
                        @if ($experts->count())
                            @foreach ($experts as $expert)
                                <div class="col-12 col-lg-4">
                                    <div class="card-info wow animate__animated  animate__flipInY">
                                        <a href="{{route('w.expert.show',$expert->customer->slug)}}" title="{{$expert->customer->fullname}}">
                                            <div class="images">
                                                <img src="{{asset($expert->customer->avatar)}}" alt="">
                                            </div>
                                            <div class="info">
                                                <h3 class="name">{{ $expert->customer->fullname}}</h3>
                                                <a href="mailto:{{ $expert->customer->email}}" class="gmail" data-toggle="tooltip" data-placement="bottom" title="Gửi mail"><i class="fa-solid fa-envelope"></i></a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12 text-center">
                                {{ $experts->links()}}
                            </div>
                        @else
                            @include('web.components.alert_text',['text_alert' => 'Không tìm thấy chuyên gia phù hợp!'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

