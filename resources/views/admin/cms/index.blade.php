@extends('admin.layouts.master')

@section('page_title', 'Quản lý CMS')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a href="{{ route('ad.cms.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Tạo mới</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <hr>
                <div class="portlet-title">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tiêu đề</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="exampleInputEmail1" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="">&nbsp;</label>
                                    <button class="btn btn-primary form-control" type="submit">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>                        
                    </form>
                </div>
                <hr>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Link</th>
                                <th width="550">Mô tả</th>
                                <th width="110">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cms as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td><img src="{{ $item->image }}" style="max-width: 200px" alt=""></td>
                                <th>{{ route('w.cms',  $item->slug) }}</th>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.cms.edit', $item) }}"><i class="fa fa-pencil"></i></a>
                                    <form action="{{ route('ad.cms.destroy', $item) }}" id="delete-course-item-form" style="display: inline-block" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        {{ $cms->links() }}
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
