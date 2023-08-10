@extends('web.layouts.master')
@section('page_title', 'Lựa chọn chuyên gia đồng hành')
@section('page_keywords', config('constant.page_keywords_select'))
@section('page_description', config('constant.page_description_select'))
@section('page_og:image')
@section('content')
    <div id="select-expert">
        <div class="container">
            <h2 class="text-primary text-center title">Lựa chọn chuyên gia đồng hành với bạn</h2>
            <div class="row">
                @if ($experts->count())
                    @foreach ($experts as $expert)
                        <div class="col-12 col-md-6 col-lg-4 my-2">
                            <form action="{{route('w.course.save_selected_expert', ['course' => $course, 'expert' => $expert])}}" id="select-expert-form" method="POST">
                                @csrf
                                <div class="form-check">
                                    <input type="radio" name="test" id="{{$expert->customer->id}}" class="expert-input"/>
                                    <label for="{{$expert->customer->id}}">
                                        <div class="images">
                                            <img src="{{asset($expert->customer->avatar)}}" class="img-expert"/>
                                        </div>
                                        <div class="info">
                                            <h3 class="name">{{ $expert->customer->fullname}}</h3>
                                            <a href="{{ route('w.expert.show', $expert->customer->slug)}}" target="_blank" title="Thông tin chuyên gia">
                                                <span style="color:red">Xem thông tin chuyên gia</span>
                                            </a>
                                        </div>
                                        <div class="text-center">
                                            <a class="btn btn-primary w-100">
                                                Chọn
                                            </a>
                                        </div>
                                    </label>
                                </div>
                            </form>
                        </div>
                    @endforeach
                @else
                    @include('web.components.alert_text',['text_alert' => 'Thông tin về chuyên gia đang được cập nhật!'])
                    @include('web.components.btn_pre_page')
                @endif
            </div>
        </div>
    </div>
@endsection
