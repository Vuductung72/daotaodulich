@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Thông tin chi tiết Công ty thực tập')
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
                            <div class="col-12 col-md-8">
                                <label for="title">Tiêu đề: </label>
                                <div >
                                    <input type="text" class="form-control" id="title" value="{{ $internship->title }}" name="title" placeholder="Nhập tiêu đề tuyển dụng ..." readonly>
                                </div>
                            </div>

                            <div class="col-12 col-md-8">
                                <label for="title">Tên công ty: </label>
                                <div >
                                    <input type="text" class="form-control" id="title" value="{{ $internship->customer->fullname }}" name="title" placeholder="Nhập tiêu đề tuyển dụng ..." readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="profession_id">Nghành nghề tuyển chọn:</label>
                                <select class="form-control" id="profession_id" name="profession_id" readonly>
                                    <option value="{{$internship->profession->id}}">{{$internship->profession->name}}</option>
                                </select>
                                <label id="profession_id-error" class="error" for="profession_id"></label>
                            </div>
    
                            <div class="col-12 col-md-8">
                                <label for="quantity">Số lượng thực tập cần tuyển: </label>
                                <div >
                                    <input type="number" class="form-control" id="quantity" placeholder="ví dụ: 5" value="{{ $internship->quantity }}" name="quantity"  min="1" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="quantity">Số lượng thực tập đã ứng tuyển: </label>
                                <div >
                                    <input type="number" class="form-control" id="quantity-recruitment" value="{{ $count }}" name="quantity-recruitment"  readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="time">Thời gian thực tập (tháng):</label>
                                <div>
                                    <input type="number" class="form-control" id="time" name="time"  placeholder="ví dụ: 3" value="{{ $internship->time }}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="start_time">Thời gian bắt đầu thực tập:</label>
                                <input type="date" class="form-control" id="start_time" placeholder="" value="{{ $internship->start_time }}" name="start_time" readonly>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="wage">Lương (VND/tháng): </label>
                                <div>
                                    <input type="text" class="form-control input-money" id="wage" placeholder="ví dụ: 3000000 " value="{{ number_format($internship->wage) }}" name="wage" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <label for="status">Trạng thái </label>
                                <select class="form-control" id="status" name="status" readonly>
                                    <option value="{{$internship->status}}"> {{ $internship->status==0 ? 'Ẩn': 'Hiện' }}  </option>
                                 </select>
                            </div>  
                            <div class="col-12 col-md-8">
                                <label for="describe">Mô tả:</label>
                                <textarea class="form-control" id="describe" rows="5" placeholder="Nhập mô tả...." name="describe" readonly>{{$internship->describe}}</textarea>
                            </div> 
                        </div>
                        <div class="form-actions">
                            <a href="{{ route('ad.news-internship.index')}}" class="send">Quay lại</a>
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

