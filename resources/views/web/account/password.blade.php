@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Đổi mật khẩu')
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
                                <h5 class="title-page">Đổi mật khẩu</h5>
                            </div>
                            <form action="{{route('w.account.change_password', customer()->user())}}"
                                id="form-pasword-account" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password">Mật khẩu mới:</label>
                                            <div style="position: relative">
                                                <input type="password" class="form-control" placeholder="Mật khẩu mới..." id="password"  name="password">
                                                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                            
                                        </div>

                                        <div class="form-group">
                                            <label for="re-password">Nhập lại mật khẩu:</label>
                                            <div style="position: relative">
                                                <input type="password" class="form-control" placeholder="Nhập lại mật khẩu..." id="re-password"  name="re-password">
                                                <span toggle="#re-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                            
                                        </div>

                                        <button type="submit" class="btn btn-account">Đổi mật khẩu</button>
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
