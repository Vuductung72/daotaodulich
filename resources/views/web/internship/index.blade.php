@extends('web.layouts.master')
@section('page_title', 'Thực tập')
@section('page_keywords', config('constant.page_keywords_internship'))
@section('page_description', config('constant.page_description_internship'))
@section('page_og:image',asset(config('constant.page_images_internship')))
@section('content')
    <div id="page-internship">
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
                                    <a href="{{route('w.internship.search_by_profession',$profession->slug)}}" class="d-flex align-items-center">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                        <h5 class="{{request()->is(['nganh-nghe/'.$profession->slug]) ? 'text-primary professionId' : ''}}" id="{{$profession->id}}">{{$profession->name}}</h5>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9 col-md-8">
                    <div class="row">
                        @if ($internships->count())
                            @foreach ($internships as $internship)
                                <div class="col-12 col-lg-4">
                                    <div class="card-info card-internship wow animate__animated  animate__flipInY">
                                        <a href="{{ route('w.internship.show', $internship->slug) }}" title="{{$internship->title}}">
                                            <div class="images">
                                                <img src="{{asset($internship->customer->avatar)}}" alt="">
                                            </div>
                                            <div class="info">
                                                <h3 class="name">{{ $internship->title}}</h3>
                                                <p class="address"><b>Ngành nghề: </b>{{ $internship->profession->name}}</p>
                                                <p class="address"><b>Công ty: </b>{{ $internship->customer->fullname}}</p>
                                            </div>
                                        </a>
                                        {{-- @if (Auth::guard('user')->check())
                                            @if (in_array($internship->profession_id, $proInternship))
                                                @if ($recruitment->where(['type' => 1, 'user_id' => customer()->user()->id, 'internship_id' => $internship->id])->first() === null)
                                                    <form action="{{ route('w.internship.recruitment', $internship)}}" method="POST" style="padding: 0 4px 8px">
                                                        @csrf
                                                        <button class="btn btn-primary w-100">Ứng tuyển</button>
                                                    </form>
                                                @else
                                                    @if ($recruitment->where(['type' => 1, 'user_id' => customer()->user()->id, 'internship_id' => $internship->id])->first()->status === 1)
                                                        <form action="{{ route('w.internship.delete-recruitment', $internship)}}" method="POST" style="padding: 0 4px 8px">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="btn btn-danger w-100">Hủy yêu cầu</button>
                                                        </form>
                                                    @elseif ($recruitment->where(['type' => 1, 'user_id' => customer()->user()->id, 'internship_id' => $internship->id])->first()->status === 2)
                                                        <div class="btn btn-circle btn-success w-100 no-pointer">
                                                            Ðã xác nhận
                                                        </div>
                                                    @elseif ($recruitment->where(['type' => 1, 'user_id' => customer()->user()->id, 'internship_id' => $internship->id])->first()->status === 3)
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
                                        @endif --}}
                                        @if (Auth::guard('user')->check())
                                            @if (in_array($internship->profession_id, $proInternship))
                                            {{-- {{$internship->userCustomer}} --}}
                                                @if ($internship->userCustomer->where('user_id', customer()->user()->id)->first() === null)
                                                    <form action="{{ route('w.internship.recruitment', $internship)}}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-primary w-100">Ứng tuyển</button>
                                                    </form>
                                                    {{-- 1 --}}
                                                @else
                                                {{-- 2 --}}
                                                    @if ($internship->userCustomer->where('user_id', customer()->user()->id)->first()->status === 1)
                                                        <form action="{{ route('w.internship.delete-recruitment', $internship)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="btn btn-danger w-100">Hủy yêu cầu</button>
                                                        </form>
                                                    @elseif ($internship->userCustomer->where('user_id', customer()->user()->id)->first()->status === 2)
                                                        <div class="btn btn-circle btn-success w-100 no-pointer">
                                                            Ðã xác nhận
                                                        </div>
                                                    @elseif ($internship->userCustomer->where('user_id', customer()->user()->id)->first()->status === 3)
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
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12 text-center">
                                {{ $internships->links()}}
                            </div>
                        @else
                            @include('web.components.alert_text',['text_alert' => 'Không tìm thấy tin thực tập phù hợp!'])
{{--                            <div class="col-12">--}}
{{--                                <h5 class="text-center" style="font-weight: normal;">Không tìm thấy tin thực tập phù hợp</h5>--}}
{{--                            </div>--}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
@endpush
@endsection
