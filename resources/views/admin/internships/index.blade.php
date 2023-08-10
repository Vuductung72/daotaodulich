@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Danh sách công ty thực tập')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        {{-- <a href="{{ route('ad.courses.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Thêm mới</a> --}}
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-title">
                    <form action="{{ route('ad.internship.search') }}" method="GET">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="internship" class="form-control" value="{{ isset($internship) ? $internship : ''}}" id="exampleInputEmail1" placeholder="Nhập tên công ty thực tập cần tìm....">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-primary form-control" type="submit">Tìm kiếm</button>
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
                                <th>Công ty</th>
                                <th>Ảnh</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th width="130">Trạng thái</th>
                                <th width="160">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $customer->fullname }}</td>
                                    <td><img src="{{ $customer->avatar == null ? '/images/no_image.png' :$customer->avatar }}" style="max-width: 35px" alt=""></td>
                                    <td>{{ $customer->email}}</td>
                                    <td>{{ $customer->regular_address}}</td>
                                    <td>{{ $customer->phone}}</td>
                                    <td>{{ $customer->status ? ($customer->status == 1 ? 'Chưa xác nhận' : 'Đã xác nhận') : '....'}}</td>
                                    <td>
                                        <a class="btn btn-circle btn-sm  {{($customer->status == 2) ? 'btn-primary' : 'btn-warning'}}" href="{{ route('ad.internship.edit', $customer) }}">{{ ($customer->status == 1) ? 'Xem thay đổi' : 'Xem chi tiết'}}</a>      
                                        <form action="{{ route('ad.internship.update',$customer) }}" method="POST" style="display: inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-circle btn-sm {{ $customer->status == 1 ? 'btn-primary' : 'btn-info'}}">
                                                <i class="fa {{ $customer->status == 1 ? 'fa-eye-slash' : 'fa-eye'}}"></i>
                                            </button>
                                        </form>                                                                                  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="text-center">
                        {{ $courses->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
@endpush

@push('scripts')
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    {{-- <script src="{{ asset('global/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script> --}}
    <!-- END PAGE LEVEL SCRIPTS -->
@endpush
