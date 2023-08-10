@extends('customer.layouts.master')
@section('page_title', 'Đăng Nhập')
@section('page_keywords', config('constant.page_keywords_customer_login'))
@section('page_description', config('constant.page_description_customer_login'))
@section('page_og:image',asset(config('constant.page_images')))
@section('content')
    <div id="login-customer">
        <div class="container ">
            <div class="row login-content" >
                <div class="col-12 col-lg-6">
                    <div class="box-image">
                        <img src="{{ asset('web/asset/images/login-customer.webp')}}" alt="signin">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="layout-form-customer">
                        <h2>Đăng Nhập</h2>
                        <form action="{{route('us.login.check')}}" method="POST" id="customer-login">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" placeholder="Nhập email...." id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu:</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu...." id="password" name="password">
                                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            {{-- <div class="text-right">
                                <a href="" class="forgot-password">Quên mật khẩu</a>
                            </div> --}}
                            <div class="form-group">
                                <button type="submit" id="signin" class="form-submit">Đăng Nhập</button>
                            </div>
                        </form>
                        <p class="link-page-register">Bạn chưa có tài khoản ?<a href="{{route('us.register.create')}}"> Đăng ký</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
