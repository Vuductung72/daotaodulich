@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Khóa học đã mua')
@section('content')
    <div id="page-mycourse">
        <div class="container">
            <div class="main-content">
                <div class="row">
                    @include('web.account.sidebar')

                    <div class="col-12 col-lg-9">
                        <div class="mycourse-information">
                            <div class="header-mycourse">
                                <h3 class="title-page">Khu vực học tập</h5>
                            </div>
                            <div class="mycouse-list">
                                <h3>Danh sách khóa học</h3>
                                <small>Khóa học, tài liệu mà bạn đăng ký sẽ được hiển thị dưới đây</small>
                                <ul>
                                    @foreach ($boughts as $bought)
                                        <li class="mycourse-item">
                                            <a href="{{route('w.course.show',$bought->course->slug)}}">
                                                <img src="{{ asset($bought->course->thumb)}}" alt="">
                                                <div class="mycourse-title">
                                                    <h5 class="text-info">{{ $bought->course->name}}</h5>
                                                    <span>Ngày đăng ký: {{\Carbon\Carbon::createFromDate($bought->created_at)->format('d/m/Y')}}</span>
                                                </div>
                                                <div class="mycourse-status">
                                                    @if ($bought->course->exam)  
                                                        <span>Trạng thái: <span class="text-primary {{ $bought->course->exam->results->where('user_id', $bought->user_id)->where('status', 1)->count() ? 'text-success' : ''}}">{{ $bought->course->exam->results->where('user_id', $bought->user_id)->where('status', 1)->count() ? 'Hoàn thành' : 'Đang học' }}</span> </span>                                                                                                                                   
                                                    @else
                                                        <span>Trạng thái: <span class="text-primary">Đang học</span> </span>                                                                                                            
                                                    @endif
                                                </div>
                                            </a>
                                        </li>                                        
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection