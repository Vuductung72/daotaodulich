@extends('customer.layouts.master')
@section('page_title', 'Sửa tin tuyển dụng')
@section('page_keywords', config('constant.page_keywords_internship_detail'))
@section('page_description', $internship->describe)
@section('page_og:image',asset($internship->customer->avatar))
@section('content')
<div id="page-internship-information">
    <div class="container">
        <div class="row layout">
            <div class="col-12 col-lg-12">
                <h2 class="text-center">Thông tin tuyển dụng</h2>
                <form action="{{ route('us.internship.update-recruitment', $internship) }}" method="POST" autocomplete="off" enctype="multipart/form-data" id="recruitment-form">
                    {{-- @method('PUT') --}}
                    @csrf
                    <div class="form-row ">
                        <div class="col-12">
                            <label for="title">Tiêu đề: </label>
                            <div >
                                <input type="text" class="form-control" id="title" value="{{ $internship->title }}" name="title" placeholder="Nhập tiêu đề tuyển dụng ...">
                            </div>
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="col-12 col-lg-6">
                            <label for="profession_id">Nghành nghề tuyển chọn:</label>
                            <select class="form-control" id="profession_id" name="profession_id">
                                @foreach ($professions as $profession)
                                    <option value="{{$profession->id}}" {{$profession->id == $internship->profession->id ? 'selected':''}} >{{$profession->name}}</option>
                                @endforeach
                            </select>
                            <label id="profession_id-error" class="error" for="profession_id"></label>
                        </div>

                        <div class="col-12 col-lg-6">
                            <label for="quantity">Số lượng thực tập cần tuyển: </label>
                            <div >
                                <input type="number" class="form-control" id="quantity" placeholder="ví dụ: 5" value="{{ $internship->quantity }}" name="quantity"  min="1">
                            </div>
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="col-12 col-lg-6">
                            <label for="time">Thời gian thực tập (tháng):</label>
                            <div>
                                <input type="number" class="form-control" id="time" name="time"  placeholder="ví dụ: 3" value="{{ $internship->time }}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="start_time">Thời gian bắt đầu thực tập:</label>
                            <input type="date" class="form-control" id="start_time" placeholder="" value="{{ $internship->start_time }}" name="start_time" >
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="col-12 col-lg-6">
                            <label for="wage">Lương (VND/tháng): </label>
                            <div>
                                <input type="text" class="form-control input-money" id="wage" placeholder="ví dụ: 3000000 " value="{{ $internship->wage }}" name="wage">
                                <div class="input-convert-amount">
                                    <p>= <span>{{ number_format($internship->wage) }}</span> VND/Tháng</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="status">Trạng thái </label>
                            <select class="form-control" id="status" name="status">
                                <option value="{{$internship->status}}"> {{ $internship->status==0 ? 'Ẩn': 'Hiện' }}  </option>
                                <option value="{{ $internship->status==0 ? '1' : '0' }}"> {{ $internship->status==0 ? 'Hiện': 'Ẩn' }}  </option>
                             </select>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="col-12">
                            <label for="quantity">Số lượng thực tập đã ứng tuyển: </label>
                            <div >
                                <input type="number" class="form-control" value="{{ $count }}" >
                            </div>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="col-12">
                            <label for="describe">Mô tả:</label>
                            <textarea class="form-control" id="describe" rows="5" placeholder="Nhập mô tả...." name="describe">{{$internship->describe}}</textarea>
                        </div>

                    </div>
                    <div class=" button-group">
                        <a href="{{ route('us.internship.index')}}" class="send bg-info">Thông tin đơn vị thực tập</a>
                        <button type="submit" class="send">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="list-recruitment" id="list-recruitment">
            <div class="row layout">
                <div class="col-12">
                    <h2 class="text-center">Thông tin ứng tuyển</h2>
                    <div class="portlet light portlet-datatable bordered">
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="admin-table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Học viên</th>
                                        <th>SĐT</th>
                                        <th>Email</th>
                                        <th width="150">Trạng thái</th>
                                        <th>Thời gian ứng tuyển</th>
                                        <th width="180">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->index +1}}</td>
                                        <td>{{ $user->user->name }}</td>
                                        <td>{{ $user->user->phone }}</td>
                                        <td>{{ $user->user->email }}</td>
                                        <td>
                                            @if ($user->status == 1)
                                                <div class="bg-primary" style="padding: 2px; color: #fff; border-radius:2px; text-align:center">
                                                    Chưa xác nhận
                                                </div>
                                            @elseif($user->status == 2)
                                                <div class="bg-success" style="padding: 2px; color: #fff; border-radius:2px; text-align:center">
                                                    Đã xác nhận
                                                </div>
                                            @elseif($user->status == 3)
                                                <div class="bg-danger" style="padding: 2px; color: #fff; border-radius:2px; text-align:center">
                                                    Đã hủy yêu cầu
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $user->user->created_at }}</td>
                                        <td>
                                            <form action="{{ route('us.internship.status-recruitment', $user) }}" id="delete-course-item-form" style="display: inline-block" method="POST" >
                                                @csrf
                                                @method('PATCH')
                                                @if ($user->status == 1)
                                                <button class="btn btn-circle btn-sm btn-primary" title="Xác nhận ứng tuyển">
                                                    Xác nhận ứng tuyển
                                                </button>
                                                @else
                                                    @if ($user->status == 2)
                                                    <button class="btn btn-circle btn-sm btn-danger" title="Hủy xác nhận">
                                                        Hủy xác nhận
                                                    </button>
                                                    @else
                                                    <button class="btn btn-circle btn-sm btn-success" title="Xác nhận lại yêu cầu">
                                                        Xác nhận lại yêu cầu
                                                    </button>
                                                    @endif
                                                @endif
                                            </form>
                                            @if ($user->status == 2)
                                                <a href="{{route('us.internship.evaluate', ['internship'=>$internship, 'userCustomer'=>$user])}}" class="btn btn-circle btn-sm btn-primary mt-1">Đánh giá thực tập</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
