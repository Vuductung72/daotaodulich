@extends('customer.layouts.master')
@section('page_title', 'Thông tin - '.auth('customer')->user()->fullname)
@section('page_keywords', config('constant.page_keywords_internship'))
@section('page_description', auth('customer')->user()->description)
@section('page_og:image',asset(auth('customer')->user()->avatar))
@section('content')
<div id="page-internship-information">
    <div class="container">
        <div class="row layout">
            <div class="col-12">
                <h2 class="text-center">Thông tin đơn vị thực tập</h2>
                <form action="{{route('us.internship.update',auth('customer')->user())}}" method="POST" autocomplete="off" enctype="multipart/form-data" id="internship-form">
                    @method('PUT')
                    @csrf
                    <div class="form-top">
                        <div class="my-avatar">
                            <div class="box-image">
                                <img src="{{ asset(auth('customer')->user()->avatar)}}" alt="" id="avatarImage">
                            </div>
                            <div class="box-text">
                                <h3 class="name-internship">{{auth('customer')->user()->fullname}}</h3>
                                <input type="file" name="avatar" id="avatar" class="inputfile">
                                <label for="avatar" class="edit-avatar">Thay đổi ảnh</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <div class="form-row ">
                            <div class="col-12 col-lg-6">
                                <label for="fullname">Tên công ty:</label>
                                <input type="text" id="fullname"  class="form-control" name="fullname" value="{{old('fullname',auth('customer')->user()->fullname)}}" placeholder="Nhập tên công ty....">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="password">Mật khẩu mới:</label>
                                <input type="password" class="form-control password" id="password" name="password"  placeholder="Nhập mật khẩu mới...." value="">
                                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password pw-icon"></span>
                            </div>
                        </div>

                        <div class="form-row ">
                            <div class="col-12">
                                <label for="regular_address">Địa chỉ: </label>
                                <input type="text" class="form-control" id="regular_address" placeholder="Nhập địa chỉ...." value="{{old('regular_address',auth('customer')->user()->regular_address ?? '')}}" name="regular_address" >
                            </div>
                        </div>

                        <div class="form-row ">
                            <div class="col-12 col-lg-6">
                                <label for="email-internship">Email:</label>
                                <input type="text" class="form-control" id="email-internship" value="{{auth('customer')->user()->email}}" name="email" readonly>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="phone">Số điện thoại:</label>
                                <input type="text" class="form-control" id="phone" name="phone"  placeholder="Nhập số điện thoại...." value="{{old('phone', auth('customer')->user()->phone ? auth('customer')->user()->phone : '' )}}">
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="col-12">
                                <label for="description">Mô tả:</label>
                                <textarea class="form-control" id="description" rows="5" placeholder="Nhập mô tả...." name="description">{{old('description',auth('customer')->user()->description ?? '')}}</textarea>
                            </div>

                        </div>
                        <div class=" button-group">
                            <a href="{{route('us.internship.recruitment')}}" class="send bg-info">Đăng thông tin tuyển dụng</a>
                            <button type="submit" class="send">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="list-recruitment" id="list-recruitment">
            <div class="row layout">
                <div class="col-12">
                    <h2 class="text-center">Thông tin tuyển dụng đã đăng</h2>
                    <div class="portlet light portlet-datatable bordered">
                        <div class="portlet-title">
                            <form action="{{ route('us.internship.search') }}" method="GET">
                                <div class="row">
                                    <div class="col-6 ml-auto">
                                        <div class="form-group d-flex">
                                            <input type="text" name="internship" class="form-control" value="{{ isset($internships) ? $internships : ''}}" id="exampleInputEmail1" placeholder="Nhập tiêu đề tuyển dụng cần tìm....">
                                            <button class="btn btn-primary form-control d-flex justify-content-center align-items-center" type="submit" style="width: 10%"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="admin-table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Ngành nghề</th>
                                        <th>Trạng thái</th>
                                        <th width="110">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($internships as $internship)
                                    <tr>
                                        <td>{{ $loop->index +1}}</td>
                                        <td>{{ $internship->title }}</td>
                                        <td>{{ $internship->profession->name }}</td>
                                        <td>{{ $internship->status == 0 ? 'Ẩn' : 'Hiện' }}</td>
                                        <td>
                                            <a title="Chỉnh sửa tin thực tập" class="btn btn-circle btn-sm btn-warning" href="{{route('us.internship.edit-recruitment', $internship)}}"><i class="fa fa-pencil"></i></a>
                                            <form action="{{ route('us.internship.status', $internship) }}" id="delete-course-item-form" style="display: inline-block" method="POST" >
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-circle btn-sm {{ $internship->status == '0' ? 'btn-primary' : 'btn-info'}}" title="{{ $internship->status == '0' ? 'Hiện tin tuyển dụng' : 'Ẩn tin tuyển dụng'}}">
                                                    <i class="fa {{ $internship->status == '0' ? 'fa-eye-slash' : 'fa-eye'}}"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                {{ $internships->links() }}
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
