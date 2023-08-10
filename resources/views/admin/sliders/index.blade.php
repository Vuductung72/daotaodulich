@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý slider')
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
                        <a href="{{ route('ad.slider.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Thêm mới</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                            <thead>
                                <tr>
                                    <th width="40">STT</th>
                                    <th>Tên</th>
                                    <th>Ảnh</th>
                                    <th>Đường dẫn</th>
                                    <th>Vị trí</th>
                                    <th>Trạng thái</th>
                                    <th width="140">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->index +1}}</td>
                                    <td>{{ $slider->name }}</td>
                                    <td><img src="{{ $slider->image }}" alt="slider" width="200px"></td>
                                    <td>{{ $slider->url }}</td>
                                    <td>{{ $slider->position }}</td>
                                    <td>{{ $slider->type == 0 ? 'Ẩn' : 'Hiện' }}</td>
                                    <td>
                                        <a title="Chỉnh sửa tài khoản" class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.slider.edit', $slider) }}"><i class="fa fa-pencil"></i></a>
                                        <form title="Xóa tài khoản" action="{{ route('ad.slider.destroy', $slider) }}" style="display: inline-block" method="POST" onsubmit="deleteRecord()">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <form action="{{ route('ad.slider.status', $slider) }}" id="delete-course-item-form" style="display: inline-block" method="POST" >
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-circle btn-sm {{ $slider->type == '0' ? 'btn-primary' : 'btn-info'}}">
                                                <i class="fa {{ $slider->type == '0' ? 'fa-eye-slash' : 'fa-eye'}}"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            {{ $sliders->links() }}
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
