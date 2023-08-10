@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Danh sách chuyên gia')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-user"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-title">
                    <form action="{{route('ad.expert.search')}}" method="GET">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value="" id="exampleInputEmail1" placeholder="Nhập tên chuyên gia cần tìm....">
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
                                <th>Ảnh</th>
                                <th>Tên chuyên gia</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Ngành nghề</th>
                                <th width="120">Trạng thái</th>
                                <th width="160">Cập nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td><img src="{{ asset($customer->avatar)}}" style="max-width: 35px" alt=""></td>
                                    <td>{{ $customer->fullname }}</td>
                                    <td>{{ $customer->email}}</td>
                                    <td>{{ $customer->phone ? $customer->phone : '....'}}</td>
                                    <td>{{ $customer->expert ? $customer->expert->profession->name : '....' }}</td>
                                    <td>{{ ($customer->status == 2 ? "Đã xác nhận" : "Chưa xác nhận")}}</td>
                                    <td>
                                        @if ($customer->expert)
                                            <a class="btn btn-circle btn-sm  {{ ($customer->status == 2) ? 'btn-primary' : 'btn-warning'}}" href="{{ route('ad.expert.edit', $customer->id) }}">{{ ($customer->status == 1) ? 'Xem thay đổi' : 'Xem chi tiết'}}</a>                                             
                                        @endif
                                        <form action="{{ route('ad.expert.update',$customer->id) }}" method="POST" style="display: inline-block">
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
                        {{ $customers->links() }}
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
