@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Thông tin chi tiết chuyên gia')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-user"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-default" href="{{ route('ad.expert.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.expert.update',$customer->id) }}" method="POST" @submit.prevent="onSubmit">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Họ và tên chuyên gia</label>
                                    <input type="text" id="name" class="form-control" name="name"  value="{{$customer->fullname}}" placeholder="...." readonly>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="name">Tên</label>--}}
{{--                                    <input type="text" id="name" class="form-control" name="name"  value="{{$customer->expert->name}}" placeholder="...." readonly>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="birthday">Ngày,tháng,năm sinh</label>
                                    <input type="text" class="form-control" name="birthday" id="birthday" value="{{ $customer->expert->birthday ? Carbon\Carbon::parse($customer->expert->birthday)->format('d/m/Y') : '....'}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Giới tính</label>
                                    <input type="text" class="form-control" name="gender" id="gender" value="{{$customer->expert->gender == 1 ?  "Nam" : "Nữ"}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="marital_status">Tình trạng hôn nhân</label>
                                    <input type="text" class="form-control"  name="marital_status" id="marital_status" value="{{$customer->expert->marital_status == 1 ? 'Đã kết hôn' : 'Chưa kết hôn'}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="regular_address">Địa chỉ thường trú</label>
                                    <input type="text" class="form-control" name="regular_address" id="regular_address" value="{{$customer->regular_address ? $customer->regular_address : '....'}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="current_address">Địa chỉ hiện tại</label>
                                    <input type="text" class="form-control" name="current_address" id="current_address" value="{{$customer->expert->current_address ? $customer->expert->current_address : '....'}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="number" id="phone" class="form-control" name="phone"  value="{{$customer->phone ? $customer->phone : '....'}}"placeholder="Số điện thoại...." readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control" name="email"  value="{{$customer->email}}" placeholder="Nhập email...." readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="thumb">Ảnh đại diện</label>
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width:160px">
                                                <img class="img-responsive" src="{{ asset($customer->avatar) }}" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $social_network = json_decode($customer->expert->social_network,true);
                                @endphp
                                <div class="form-group">
                                    <label for="social_network">Facebook</label>
                                    <input type="text" class="form-control mb-1"  name="social_network" id="social_network" value="{{$social_network['facebook'] != null ? $social_network['facebook'] : '....'}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="social_network">Tiktok</label>
                                    <input type="text" class="form-control mb-1"  name="social_network" id="social_network" value="{{$social_network['tiktok'] != null ? $social_network['tiktok'] : '....'}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="social_network">Zalo</label>
                                    <input type="text" class="form-control mb-1"  name="social_network" id="social_network" value="{{$social_network['zalo'] != null ? $social_network['zalo'] : '.....'}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="profession">Chuyên ngành</label>
                                    <input type="text" class="form-control mb-1"  name="profession" id="profession" value="{{$customer->expert->profession ? $customer->expert->profession->name : '....'}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Thông tin khác</label>
                                    <textarea readonly class="form-control tinymce" name="" id="" rows="5">{!! $customer->expert->content ?? '....' !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            @if ($customer->status == 1)
                                <button class="btn btn-primary">Xác nhận</button>
                            @else
                                <button class="btn btn-primary">Ẩn</button>
                            @endif
                            <a href="{{ route('ad.expert.index') }}" class="btn btn-default">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link href="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endpush

@prepend('scripts')
<script src="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('admin.lib.tinymce-setup')

@endprepend

