@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý bài viết')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-pencil-square" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a href="{{ route('ad.blog.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Tạo mới</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-title">
                    <form action="{{ route('ad.blog.search') }}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Tên bài viết</label>
                                    <input type="text" name="name" class="form-control" value="{{ isset($name) ? $name : ''}}" id="name" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category_id">Danh mục</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="">Tất cả</option>
                                        @foreach ($categories as $category)
                                            @if (isset($category_id))
                                                <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>                                                
                                            @else
                                                <option value="{{ $category->id }}">{{$category->name}}</option>                                                
                                            @endif
                                        @endforeach
                                    </select>
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
                <div class="portlet-body" style="background: #fff">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th width="550">Mô tả</th>
                            <th width="150">Danh mục</th>
                            <th width="150">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($blogs as $key => $blog)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $blog->name }}</td>
                                <td><img src="{{ $blog->image }}" style="max-width: 50px" alt=""></td>
                                <td>{{ $blog->description ? $blog->description : '...'}}</td>
                                <td>{{ $blog->category ? $blog->category->name : 'Chưa xác định'}}</td>
                                <td>
                                    <a title="Chỉnh sửa bài viết" class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.blog.edit', $blog) }}"><i class="fa fa-pencil"></i></a>
                                    <form action="{{ route('ad.blog.update_status', $blog) }}" id="delete-course-item-form" style="display: inline-block" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn @php echo $blog->status == 1 ?  'ẩn' : 'hiện' @endphp bài viết?');">
                                        @csrf
                                        @method('PATCH')
                                        <button title="Cập nhật trạng thái bài viết" class="btn btn-circle btn-sm {{ $blog->status == 1 ? 'btn-primary' : 'btn-info' }}  ">
                                            @if ($blog->status == 1)
                                                <i class="fa fa-eye" aria-hidden="true"></i>                                                
                                            @else
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>                                                                                                
                                            @endif
                                        </button>
                                    </form>
                                    <form action="{{ route('ad.blog.destroy', $blog) }}" id="delete-course-item-form" style="display: inline-block" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button title="Xóa bài viết" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $blogs->links('web.layouts.paginate') }}
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
