@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Đánh giá học viên')
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
                        <a class="btn btn-circle btn-default" href="{{ route('ad.news-internship.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    {{-- {{dd($customer)}} --}}
                    <form action="" method="POST" autocomplete="off" enctype="multipart/form-data" id="recruitment-form">
                        {{-- @method('PUT') --}}
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label for="title">Họ và tên: </label>
                                <div >
                                    <input type="text" class="form-control" id="title" value="{{ $userCustomer->user->name }}" name="title" placeholder="Nhập tiêu đề tuyển dụng ..." readonly>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="title">Giới tính: </label>
                                <div >
                                    <input type="text" class="form-control" id="title" value="{{ $userCustomer->user->gender == 1 ? 'Nam' : 'Nữ'}}"  name="title" placeholder="Nhập tiêu đề tuyển dụng ..." readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="profession_id">Email</label>
                                <div >
                                    <input type="text" class="form-control" id="title" value="{{ $userCustomer->user->email}}"  name="title" placeholder="Nhập tiêu đề tuyển dụng ..." readonly>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="quantity">Số điện thoại</label>
                                <div >
                                    <input type="number" class="form-control" id="quantity" placeholder="ví dụ: 5" value="{{ $userCustomer->user->phone }}" name="quantity"  min="1" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="time">Địa chỉ</label>
                                <div>
                                    <input type="text" class="form-control" value="{{ $userCustomer->user->address }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="describe">Đánh giá:</label>
                                <p>
                                    {!! $userCustomer->content !!}
                                </p>
                            </div>
                        </div>
                        <div class="form-actions">
                            <a href="{{ route('ad.list-intern', $internship)}}" class="send">Quay lại</a>
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

