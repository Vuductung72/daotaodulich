@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Đánh giá thực tập')
@section('content')
    <div id="page-mycourse">
        <div class="container">
            <div class="main-content">
                <div class="row">
                    <div class="col-12">
                        <div class="mycourse-information">
                            <div class="header-mycourse">
                                <h3 class="title-page">Thông tin đánh giá</h3>
                                <a href="{{route('w.account.intership')}}">Quay lại</a>
                            </div>
                            <div class="mycouse-list">
                                <div class="form-row">
                                    <div class="col-12 col-lg-6">
                                        <label for="name">Tin thực tập:</label>
                                        <input type="text" id="name"  class="form-control" name="name" value="{{$userCustomer->internship->title}}" readonly>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="gender">Đơn vị:</label>
                                        <input type="text" id="gender"  class="form-control" name="gender" value="{{$userCustomer->internship->customer->fullname}}" readonly>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-lg-6">
                                        <label for="name">Lương:</label>
                                        <input type="text" id="name"  class="form-control" name="name" value="{{number_format($userCustomer->internship->wage)}} VND" readonly>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="gender">Địa chỉ:</label>
                                        <input type="text" id="gender"  class="form-control" name="gender" value="{{$userCustomer->internship->customer->regular_address}}" readonly>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-lg-6">
                                        <label for="gender">Thời gian thực tập:</label>
                                        <input type="text" id="gender"  class="form-control" name="gender" value="{{$userCustomer->internship->time}} tháng" readonly>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="gender">Thời gian bắt đầu:</label>
                                        <input type="text" id="gender"  class="form-control" name="gender" value="{{$userCustomer->internship->start_time}} tháng" readonly>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12">
                                        <label>Đánh giá</label>
                                        <p>
                                            {!! $userCustomer->content !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #page-mycourse{
            padding: 0;
        }
        .header-mycourse{
            justify-content: space-between;
        }

        .mycourse-status{
            width: 35%;
        }

        .mycourse-item a{
            margin: 8px 0 0;
        }

        .mycouse-list{
            text-align: left;
        }
        .form-row{
            margin: 8px 0
        }
    </style>
@endpush
