@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Thông tin tài khoản')
@section('content')
    {{-- <section class="section-bank"> --}}
    <div id="page-account">
        <div class="container">
            <div class="main-content">
                <div class="row">

                    {{-- sidebar account --}}
                    @include('web.account.sidebar')

                    {{-- content account --}}

                    <div class="col-12 col-lg-9">
                        <div class="account_infomation">
                            <div class="header-account">
                                {{-- <a href="index.html"  class="btn-out-tab" title="Trở về trang chủ"><i class="fa-solid fa-arrow-left"></i></a> --}}
                                <h5 class="title-page">Thông tin tài khoản</h5>
                            </div>
                            <form action="{{ route('w.account.update', customer()->user())}}"
                                id="form-edit-account" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row my-4">
                                
                                    <div class="col-12 col-md-4">
                                        <div class="box-avatar">
                                            <div class="avatar">
                                                <img src="{{asset(customer()->user()->avatar)}}" alt="avatar" id="avatarImage">
                                            </div>
                                            <div class="box-text">
                                                <input type="file" name="avatar" id="avatar" class="inputfile" />
                                                <label for="avatar" class="edit-avatar">Thay đổi ảnh</label>
                                                <h5 class="name">{{ customer()->user()->name }}</h5>
                                            </div>
                                        </div>    
                                    </div>

                                    <div class="col-12 col-md-8">
                                        <div class="form-group">
                                            <label for="name">Họ và Tên:</label>
                                            <input type="text" class="form-control" placeholder=" Họ và Tên"
                                                id="name" value="{{ old('name', customer()->user()->name) }}"
                                                name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" placeholder=" email" id="email"
                                                value="{{ old('email', customer()->user()->email) }}" name="email"
                                                disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Địa chỉ:</label>
                                            <input type="text" class="form-control" placeholder="Địa chỉ" id="address"
                                                value="{{ old('address', customer()->user()->address) }}" name="address">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Điện thoại:</label>
                                            <input type="text" class="form-control" placeholder="Điện thoại"
                                                id="phone" value="{{ old('phone', customer()->user()->phone) }}"
                                                name="phone">
                                        </div>
                                        <div class="form-group form-row">
                                            <div class="col">
                                                <label for="gender">Giới tính:</label>
                                                <select class="form-control" id="gender" name="gender" value="{{ old('gender', customer()->user()->gender) }}">
                                                    <option value="{{ customer()->user()->gender }}">{{ customer()->user()->gender == '1' ? 'Nam' : 'Nữ' }}</option>
                                                    @if(customer()->user()->gender == "1")
                                                        <option value="0"> Nữ </option>
                                                    @else
                                                        <option value="1"> Nam </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-account">Lưu thay đổi</button>
                                    </div>
                                </div>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </section> --}}
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}"/>

@endpush

@prepend('scripts')
<script src="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('admin.lib.tinymce-setup')
<script>
    $('document').ready(function(){
    })
</script>
@endprepend
