@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Thông tin chi tiết Công ty thực tập')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        {{-- <i class="fa fa-user"></i> --}}
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-default" href="{{ route('ad.internship.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    {{-- {{dd($customer)}} --}}
                    <form action="{{ route('ad.internship.update',$customer) }}" method="POST" @submit.prevent="onSubmit">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Tên chuyên gia</label>
                                    <input type="text" id="name" class="form-control" name="name"  value="{{$customer->fullname}}" placeholder="Nhập tên chuyên gia...." readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control" name="email"  value="{{$customer->email}}" placeholder="Nhập email...." readonly>
                                </div>
                                <div class="form-group">
                                    <label for="regular_address">Địa chỉ</label>
                                    <input type="text" id="regular_address" class="form-control" name="regular_address"  value="{{$customer->regular_address ? $customer->regular_address : '....'}}" placeholder="Địa chỉ...." readonly>
                                </div>
                                
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label for="thumb">Logo công ty</label>
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width:135px">
                                                <img class="img-responsive" src="{{ asset($customer->avatar) }}" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea id="description" class="form-control" name="description" placeholder="Nhập mô tả ngắn...." readonly>{{ old('description',$customer->description) }}</textarea>
                                </div> 
                            </div>
                        </div>
                        <div class="form-actions">
                            @if ($customer->status == 1)
                                <button class="btn btn-primary">Xác nhận</button>      
                            @else
                                <button class="btn btn-primary">Hủy xác nhận</button> 
                            @endif
                            <a href="{{ route('ad.internship.index') }}" class="btn btn-default">Quay lại</a>
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

