@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý thi ngay')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                {{-- <div class="portlet-title">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="course" class="form-control" value="" id="exampleInputEmail1" placeholder="Nhập tên khóa học cần tìm....">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-primary form-control" type="submit">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>                        
                    </form>
                </div> --}}
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Học viên</th>
                                <th>Khóa học</th>
                                <th>Trạng thái</th>
                                <th width="150">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courseUsers as $courseUser)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $courseUser->user->name}}</td>
                                    <td>{{ $courseUser->course->name}}</td>
                                    <td>{{ $courseUser->status == 0 ? "Chưa xác nhận" : "Xác nhận"}}</td>
                                    <td>
                                        <a class="btn btn-circle btn-sm {{ ($courseUser->status == 1) ? 'btn-primary' : 'btn-warning'}}" href="{{route('ad.exam-confirm.edit', $courseUser->id)}}" title="Xác nhận">
                                            {{ ($courseUser->status == 0) ? 'Xem thay đổi' : 'Xem chi tiết'}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $courseUsers->links() }}
                    </div>
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
