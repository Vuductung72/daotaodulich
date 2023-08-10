@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý danh mục')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a href="{{ route('ad.category.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Tạo mới</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Slug</th>
                                    <th>Type</th>
                                    <th>Mô tả ngắn</th>
                                    <th width="140">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td><img src="{{ $category->image }}" style="max-width: 50px" alt=""></td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->type == 0 ? 'Tin tức' : 'Điều khoản dịch vụ'}}</td>
                                    <td>{{ $category->description ? $category->description : '....'}}</td>
                                    <td>
                                        <a class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.category.edit', $category) }}"><i class="fa fa-pencil"></i></a>
                                        <form action="{{ route('ad.category.destroy', $category) }}" id="delete-course-item-form" style="display: inline-block" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <form action="{{ route('ad.category.status', $category) }}" id="delete-course-item-form" style="display: inline-block" method="POST" >
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-circle btn-sm {{ $category->status == 0 ? 'btn-primary' : 'btn-info'}}">
                                                <i class="fa {{ $category->status == 0 ? 'fa-eye-slash' : 'fa-eye'}}"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            {{ $categories->links() }}
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
