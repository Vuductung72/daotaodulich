@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Danh sách người thực tập')
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
                        <a href="{{ route('ad.news-internship.index') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
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
                                    @if ($user->status == 2)
                                        <a href="{{route('ad.show-intern', ['internship'=>$internship, 'userCustomer'=>$user])}}" class="btn btn-circle btn-sm btn-primary">Xem đánh giá</a>
                                    @endif
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
