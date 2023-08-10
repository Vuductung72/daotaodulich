@extends('web.layouts.master')
@section('page_title', $internship->customer->fullname . ' - ' . $internship->title)
@section('page_keywords', config('constant.page_keywords_internship_detail'))
@section('page_description', $internship->describe)
@section('page_og:image', asset($internship->customer->avatar))
@section('content')
    <div id="show-info-internship">
        <div class="container" id="show-info">
            <div class="row show-info-top">
                <div class="col-lg-4">
                    <div class="my-avatar">
                        <img src="{{asset($internship->customer->avatar)}}" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <h3 class="title-col">{{ $internship->title}}</h3>
                    <p class="describe"> <b>Công ty:</b>: {{ $internship->customer->fullname}}</p>
                    <p class="describe"> <b>Mô tả công ty</b>: {{ $internship->customer->description}}</p>
                </div>
            </div>
            <div class="row show-info-bottom">
                <div class="col-12 col-lg-4 mb-3">
                    <h3 class="title-col"> Liên Hệ </h3>
                        <ul class="contact">
                            {{-- <li class="d-flex "><div class="box-icons"><i class="fa-solid fa-phone"></i></div>
                            </li> --}}
                            <li class="d-flex "><div class="box-icons"><i class="fa-solid fa-envelope"></i></div>
                                {{ $internship->customer->email}}
                            </li>
                            <li class="d-flex "><div class="box-icons"><i class="fa-solid fa-location-dot"></i></div>
                                {{ $internship->customer->regular_address}}
                            </li>
                        </ul>
                </div>
                <div class="col-12 col-lg-8 mb-3">
                    <h3 class="title-col">Chi tiết</h3>
                    <p><b>Ngành nghề tuyển dụng: </b>
                        {{ $internship->profession->name}}
                    </p>
                    <p><b>Số lượng tuyển: </b>
                        {{ $internship->quantity}} người
                    </p>
                    <p><b>Mức lương: </b>
                        {{ number_format($internship->wage)}} vnđ
                    </p>
                    <p><b>Thời gian thực tập: </b>
                        {{ $internship->time}} tháng
                    </p>
                    <p><b>Thời gian bắt đầu làm việc: </b>
                        {{  \Carbon\Carbon::parse($internship->start_time)->format('d-m-Y')}}
                    </p>
                    <p><b>Mô tả công việc: </b>
                        {{ $internship->describe}}
                    </p>
                </div>
                @if (Auth::guard('user')->check())
                    <div class="col-12">
                    @if (in_array($internship->profession_id, $proInternship))
                        @if ($recruitment->where('user_id', customer()->user()->id)->where('internship_id', $internship->id)->first() == null)
                            <form action="{{ route('w.internship.recruitment', $internship)}}" method="POST" style="padding: 0 4px 8px">
                                @csrf
                                <button class="btn btn-primary w-100">Ứng tuyển</button>
                            </form>
                            @else
                                @if ($recruitment->where('user_id', customer()->user()->id)->where('internship_id', $internship->id)->first()->status == 1)
                                    <form action="{{ route('w.internship.delete-recruitment', $internship)}}" method="POST" style="padding: 0 4px 8px">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-danger w-100">Hủy yêu cầu</button>
                                    </form>
                                @elseif ($recruitment->where('user_id', customer()->user()->id)->where('internship_id', $internship->id)->first()->status == 2)
                                    <div class="btn btn-circle btn-success w-100 no-pointer">
                                        Ðã xác nhận
                                    </div>
                                @elseif ($recruitment->where('user_id', customer()->user()->id)->where('internship_id', $internship->id)->first()->status == 3)
                                    <div class="btn btn-circle btn-danger w-100 no-pointer">
                                        Yêu cầu đã bị hủy
                                    </div>
                                @endif
                            @endif
                        @else
                            <div style="padding: 0 4px 8px">
                                <button class="btn btn-circle btn-primary w-100" disabled>
                                    Hoàn thành khóa học để ứng tuyển
                                </button>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
