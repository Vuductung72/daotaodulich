@extends('web.layouts.master')
@section('page_title', 'Đăng Nhập')
@section('page_keywords', config('constant.page_keywords_login'))
@section('page_description', config('constant.page_description_login'))
@section('page_og:image',config('constant.page_images_login'))
@section('content')
    <div class="main-sign-in">
        <section class="sign-in">
            <div class="container">
                <div class="row signin-content ">
                    <div class="col-12 col-lg-6 text-center">
                        <div class="signin-image">
                            <img src="{{ asset('web/asset/images/login.webp') }}" alt="signin">
                        </div>
                        <a href="{{route('w.home')}}" class="link-homepage">Trở về trang chủ <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="layout-form-login">
                            <form action="{{route('w.login')}}" method="POST" id="login-form">
                                @csrf
                                <h2 class="form-title">Đăng Nhập</h2>
                                <div class="form-group">
                                    <label for="email" class="material-icons-name"><i class="fa-solid fa-user"></i></label>
                                    <input type="email" name="email" id="email" class="input-box" placeholder="Nhập email ..." value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="material-icons-name"><i class="fa-solid fa-lock"></i></label>
                                    <input type="password" name="password" id="password" class="input-box" placeholder="Nhập mật khẩu ..." value="{{old('password')}}">
                                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                {{-- <div class="text-right">
                                    <a href="" class="forgot-password">Quên mật khẩu</a>
                                </div> --}}
                                <div class="form-group form-button">
                                    <button type="submit" id="signin" class="form-submit test">Đăng Nhập</button>
                                </div>
                            </form>
                            {{-- <form action="{{route('w.login')}}" method="post">
                                @csrf
                                <input type="email" name="email" id="email" placeholder="Nhập email ..." value="{{old('email')}}">
                                <button type="submit" class="form-submit">Đăng Nhập</button>
                            </form> --}}
                            <p class="link-page-register">Bạn chưa có tài khoản ?<a href="{{route('w.register')}}"> Đăng ký</a></p>
                            <a href="{{route('w.forget_password')}}">Quên mật khẩu?</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
