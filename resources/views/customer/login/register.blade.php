@extends('customer.layouts.master')
@section('page_title', 'Đăng Ký')
@section('page_keywords', config('constant.page_keywords_customer_register'))
@section('page_description', config('constant.page_description_customer_register'))
@section('page_og:image',asset(config('constant.page_images')))
@section('content')
    <div id="register-customer">
        <div class="container">
            <div class="row register-content">
                <div class="col-12 col-lg-6">
                    <div class="layout-form-customer">
                        <h2>Đăng Ký</h2>
                        <form action="{{route('us.register.store')}}" id="customer-register" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="fullname">Tên chuyên gia/công ty:</label>
                                <input type="text" class="form-control" placeholder="Nhập tên...." id="fullname" name="fullname" value="{{old('fullname')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" placeholder="Nhập email...." id="email" name="email" value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu:</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu...." id="password" name="password">
                                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <label for="re-password">Xác nhận mật khẩu:</label>
                                <input type="password" class="form-control" placeholder="Nhập lại mật khẩu...." id="re-password" name="re-password">
                                <span toggle="#re-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <label for="type">Loại tài khoản:</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="1" {{old('name') == 1 ? 'selected' : ''}}>Chuyên gia</option>
                                    <option value="2" {{old('name') == 2 ? 'selected' : ''}}>Nhà tuyển dụng</option>
                                  </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="signin" class="form-submit">Đăng Ký</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-6 text-center">
                    <div class="box-image">
                        <img src=" {{ asset('web/asset/images/register-customer.webp') }}" alt="signin">
                    </div>
                    <a href="{{route('us.login.index')}}" class="signup-image-link">Tôi đã là thành viên</a>
                </div>
            </div>
        </div>
    </div>

@endsection



