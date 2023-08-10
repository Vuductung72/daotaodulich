@extends('web.layouts.master')
@section('page_title', 'Đăng kí')
@section('page_keywords', config('constant.page_keywords_register'))
@section('page_description', config('constant.page_description_register'))
@section('page_og:image',config('constant.page_images_register'))
@section('content')
    <div class="register--bg">
        <div class="container register-content">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="register-form-box">
                        <h2 class="register-title">Đăng kí</h2>
                        <form action="{{route('w.register')}}" method="POST" class="register-form" id="register-form">
                            @csrf
                            <div class="form-group form-group__underlined">
                                <label for="username" class="material-icons-name"><i class="fa-solid fa-user"></i></label>
                                <input type="text" name="name" id="name" class="input-box" placeholder="Nhập tên..." value="{{old('name')}}"/>
                            </div>
                            <div class="form-group form-group__underlined">
                                <label for="email" class="material-icons-name"><i class="fa-solid fa-envelope"></i></label>
                                <input type="email" name="email" id="email" class="input-box" placeholder="Nhập Email..."  value="{{old('email')}}"/>
                            </div>
                            <div class="form-group form-group__underlined">
                                <label for="phone" class="material-icons-name"><i class="fa-solid fa-phone"></i></label>
                                <input type="phone" name="phone" id="phone" class="input-box" placeholder="Nhập số điện thoại..."  value="{{old('phone')}}"/>
                            </div>
                            <div class="form-group form-group__underlined">
                                <label for="address" class="material-icons-name icon-optional"><i class="fa-solid fa-house"></i></label>
                                <input type="text" name="address" id="address" class="input-box" placeholder="Nhập địa chỉ..."  value="{{old('address')}}"/>
                            </div>
                            <div class="form-group form-group__underlined">
                                <label for="password" class="material-icons-name"><i class="fa-solid fa-lock"></i></label>
                                <input type="password" name="password" id="password" class="input-box" placeholder="Nhập mật khẩu..."/>
                                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group form-group__underlined">
                                <label for="re-password" class="material-icons-name"><i class="fa-solid fa-lock"></i></label>
                                <input type="password" name="re-password" id="re-password" class="input-box" placeholder="Nhập lại mật khẩu..."/>
                                <span toggle="#re-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-check form-check-inline" style="margin-bottom: 20px">
                                <label for="gender" style="margin: 0"><i class="fa-solid fa-person-half-dress"></i></label>
                                <div class="form-check">
                                    <label for="male" style="margin: 0">Nam</label>
                                    <input type="radio" name="gender" id="male" value="1" checked>
                                </div>
                                <div class="form-check">
                                    <label for="female" style="margin: 0">Nữ</label>
                                    <input type="radio" name="gender" id="female" value="0">
                                </div>

                            </div>
                            <div class="form-group ">
                                <div class="d-flex">
                                    <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                    <label for="agree-term" class="label-agree-term">Tôi đồng ý tất cả các điều khoản trong
                                        <a href="#" class="term-service">điều khoản dịch vụ</a>
                                    </label>
                                </div>
                                <label id="agree-term-error" class="error" for="agree-term"></label>
                            </div>
                            <div class="form-group form-button">
                                <button  id="register" class="form-submit">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="register-image">
                        <fieldset>
                            <img src="{{ asset('web/asset/images/register.webp') }}" alt="">
                        </fieldset>
                        <a href="{{route('w.get_login')}}" class="signup-image-link">Tôi đã là thành viên</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



