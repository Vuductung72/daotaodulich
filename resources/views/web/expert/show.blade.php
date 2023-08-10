@extends('web.layouts.master')
@section('page_title', 'Thông tin chuyên gia: '.$customer->fullname)
@section('page_keywords', config('constant.page_keywords_expert_detail'))
@section('page_description', $customer->description)
@section('page_og:image',asset($customer->avatar))
@section('content')
    <div id="show-info-expert">
        <div class="container" id="show-info">
            <div class="row">
                <div class="col-lg-4 show-info-left">
                    <div class="my-avatar">
                        <img src="{{asset( $customer->avatar)}}" alt="">
                    </div>
                    <h2 class='name text-center'>
                        {{ $customer->fullname}}
                    </h2>
                    <ul class="social-network-link d-flex justify-content-center">
                        @if ($social_network['facebook'] != null)
                            <li>
                                <a href="{{ $social_network['facebook'] }}" title="facebook" target="_blank">
                                    <div class="box-icons d-flex" >
                                        <i class="fa-brands fa-facebook"></i>
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if ($social_network['zalo'] != null)
                           <li>
                                <a href="{{ $social_network['zalo'] }}" title="zalo" target="_blank">
                                    <div class="box-icons d-flex ">
                                        <img src="{{ asset('web/asset/images/zalo-blue.svg') }}" alt="">
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if ($social_network['tiktok'] != null)
                            <li>
                                <a href="{{ $social_network['tiktok'] }}" title="tiktok" target="_blank">
                                    <div class="box-icons d-flex" >
                                        <i class="fa-brands fa-tiktok"></i>
                                    </div>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <div class="box-information">
                        <h3 class="title">Thông tin</h3>
                        <ul>
                            <li>
                                <span><b>Ngày, tháng, năm sinh</b>: {{ $customer->expert->birthday != null ? \Carbon\Carbon::parse($customer->expert->birthday)->format('d/m/Y') : ''}}</span>
                            </li>
                            <li>
                                <span><b>Giới tính</b>: {{ $customer->expert->gender == 1 ? 'Nam' : 'Nữ'}}</span>
                            </li>
                            <li>
                                <span><b>Quốc tịch</b>: {{ $customer->expert->nationality}}</span>
                            </li>
                            <li>
                                <span><b>Tình trạng hôn nhân</b>: {{ $customer->expert->marital_status == 1 ? 'Đã kết hôn' : 'Chưa kết hôn'}}</span>
                            </li>
                            <li>
                                <span><b>Địa chỉ thường trú</b>: {{ $customer->regular_address}}</span>
                            </li>
                            <li>
                                <span><b>Địa chỉ hiện tại</b>: {{ $customer->expert->current_address}}</span>
                            </li>
                            <li>
                                <span><b>Số điện thoại</b>: {{ $customer->phone}}</span>
                            </li>
                            <li>
                                <span><b>Email</b>: {{ $customer->email}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 show-info-right">
                    <h3 class="title-col">Thông tin liên quan</h3>
                    <div class="expert-description">
                        <p>
                            {!! $customer->expert->content !!}
                        </p>
                    </div>

                </div>
            </div>
            {{-- <div class="row show-info-bottom">
                <div class="col-12 col-lg-6 mb-3">
                    <h3 class="title-col"> Liên Hệ </h3>
                        <ul class="contact">
                            <li class="d-flex "><div class="box-icons"><i class="fa-solid fa-phone"></i></div>
                                {{ $customer->phone}}
                            </li>
                            <li class="d-flex "><div class="box-icons"><i class="fa-solid fa-envelope"></i></div>
                                {{ $customer->email}}
                            </li>
                        </ul>
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <h3 class="title-col">Mạng xã hội</h3>
                </div>
                <div class="col-12 mb-3">
                    <h3 class="title-col">Thông tin liên quan</h3>

                </div>
            </div> --}}
        </div>
    </div>

@endsection
