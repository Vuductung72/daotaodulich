@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý đối tác')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a href="{{ route('ad.partner.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Thêm mới</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                            <thead>
                                <tr>
                                    <th width="40">STT</th>
                                    <th>Tên đối tác</th>
                                    <th>Ảnh</th>
                                    <th>Email</th>
                                    <th>Số điện thọai</th>
                                    <th>Địa chỉ</th>
                                    <th width="110">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partners as $partner)
                                <tr>
                                    <td>{{ $loop->index +1}}</td>
                                    <td>{{ $partner->name }}</td>
                                    <td><img src="{{ $partner->image }}" alt="slider" width="100px"></td>
                                    <td>{!! $partner->email !!}</td>
                                    <td>{!! $partner->phone !!}</td>
                                    <td>{!! $partner->address !!}</td>
                                    <td>
                                        <a title="Chỉnh sửa tài khoản" class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.partner.edit', $partner) }}"><i class="fa fa-pencil"></i></a>
                                        <form title="Xóa tài khoản" action="{{ route('ad.partner.destroy', $partner) }}" style="display: inline-block" method="POST" onsubmit="deleteRecord()">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            {{ $partners->links() }}
                        </table>
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
