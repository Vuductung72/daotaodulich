@extends('customer.layouts.master')
@section('page_title', 'Đánh giá học viên')
@section('page_keywords', config('constant.page_keywords_internship_detail'))
@section('page_description', $internship->describe)
@section('page_og:image',asset($internship->customer->avatar))
@section('content')
<div id="page-internship-information">
    <div class="container">
        <div class="row layout">
            <div class="col-12 col-lg-12">
                <h2 class="text-center">Đánh giá học viên</h2>
                <div class="form-row">
                    <div class="col-12 col-lg-6">
                        <label for="name">Họ và tên:</label>
                        <input type="text" id="name"  class="form-control" name="name" value="{{$userCustomer->user->name}}" readonly>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="gender">Giới tính:</label>
                        <input type="text" id="gender"  class="form-control" name="gender" value="{{$userCustomer->user->gender == 1 ? 'Nam' : 'Nữ'}}" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-12 col-lg-6">
                        <label for="email">Email:</label>
                        <input type="text" id="email"  class="form-control" name="email" value="{{$userCustomer->user->email}}" readonly>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" id="phone"  class="form-control" name="phone" value="{{$userCustomer->user->phone}}" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-12 col-lg-6">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" id="address"  class="form-control" name="address" value="{{$userCustomer->user->address}}" readonly>
                    </div>

                </div>

                <form action="{{route('us.internship.evaluate-post', ['internship'=>$internship, 'userCustomer'=>$userCustomer])}}" method="POST" autocomplete="off" enctype="multipart/form-data" id="recruitment-form">
                    @csrf
                    <div class="form-row ">
                        <div class="col-12">
                            <label for="content">Đánh giá:</label>
                            <textarea name="content" class="form-control tinymce" id="content" cols="30" rows="10" placeholder="Đánh giá...">{!!$userCustomer->content!!}</textarea>
                        </div>

                    </div>
                    <div class=" button-group">
                        <a href="{{route('us.internship.edit-recruitment', $internship)}}" class="send bg-info">Quay lại</a>
                        <button type="submit" class="send">Đánh giá</button>
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
