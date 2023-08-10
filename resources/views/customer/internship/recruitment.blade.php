@extends('customer.layouts.master')
@section('page_title', 'Đăng tin tuyển dụng')
@section('page_keywords', config('constant.page_keywords_internship_detail'))
@section('page_description', config('constant.page_description_internship_detail'))
@section('page_og:image',asset(auth('customer')->user()->avatar))
@section('content')
<div id="page-internship-information">
    <div class="container">
        <div class="row layout">
            <div class="col-12 col-lg-12">
                <h2 class="text-center">Thông tin tuyển dụng</h2>
                <form action="{{ route('us.internship.create-recruitment') }}" method="POST" autocomplete="off" enctype="multipart/form-data" id="recruitment-form">
                    {{-- @method('PUT') --}}
                    @csrf
                    <div class="form-row ">
                        <div class="col-12">
                            <label for="title">Tiêu đề: </label>
                            <div >
                                <input type="text" class="form-control" id="title" value="{{old('title')}}" name="title" placeholder="Nhập tiêu đề tuyển dụng ...">
                            </div>
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="col-12 col-lg-6">
                            <label for="profession_id">Nghành nghề tuyển chọn:</label>
                            <select class="form-control" id="profession_id" name="profession_id">
                                @foreach ($professions as $profession)
                                    <option value="{{$profession->id}}" {{old('profession_id') == $profession->id ? 'selected' : ''}}>{{$profession->name}}</option>
                                @endforeach
                            </select>
                            <label id="profession_id-error" class="error" for="profession_id"></label>
                        </div>

                        <div class="col-12 col-lg-6">
                            <label for="quantity">Số lượng thực tập cần tuyển: </label>
                            <div >
                                <input type="number" class="form-control" id="quantity" placeholder="ví dụ: 5" value="{{old('quantity')}}" name="quantity"  min="1">
                            </div>
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="col-12 col-lg-6">
                            <label for="time">Thời gian thực tập (tháng):</label>
                            <div>
                                <input type="number" class="form-control" id="time" name="time"  placeholder="ví dụ: 3" value="{{old('time')}}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="start_time">Thời gian bắt đầu thực tập:</label>
                            <input type="date" class="form-control" id="start_time" placeholder="" value="{{old('start_time')}}" name="start_time" >
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="col-12 col-lg-6">
                            <label for="wage">Lương (VND/tháng): </label>
                            <div>
                                <input type="text" class="form-control input-money" id="wage" placeholder="ví dụ: 3000000 " value="{{old('wage')}}" name="wage">
                                <div class="input-convert-amount">
                                    <p>= <span>0</span> VND/Tháng</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="status">Trạng thái </label>
                            <select class="form-control" id="status" name="status">
                                <option value="0" {{old('status') === '0' ? 'selected' : ''}}>Ẩn</option>
                                <option value="1" {{old('status') === '1' ? 'selected' : ''}}>Hiện</option>
                             </select>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="col-12">
                            <label for="describe">Mô tả:</label>
                            <textarea class="form-control" id="describe" rows="5" placeholder="Nhập mô tả...." name="describe">{{old('describe')}}</textarea>
                        </div>
                    </div>
                    <div class=" button-group">
                        <a href="{{ route('us.internship.index')}}" class="send bg-info">Thông tin đơn vị thực tập</a>
                        <button type="submit" class="send">Đăng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
