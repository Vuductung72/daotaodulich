@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý khóa học')
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
                        <a href="{{ route('ad.courses.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Thêm mới</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-title">
                    <form action="{{ route('ad.courses.search') }}" method="GET">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="course" class="form-control" value="{{ old('course') }}" id="exampleInputEmail1" placeholder="Nhập tên khóa học cần tìm....">
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
                                <th>Tên khóa học</th>
                                <th>Giá (vnđ)</th>
                                <th>Giá khuyến mãi (vnđ)</th>
                                <th>Đề thi</th>
                                <th>Đề thi thử</th>
                                <th width="110">Ngành nghề</th>
                                <th width="150">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td><img src="{{ $course->thumb }}" style="max-width: 40px" alt=""></td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ number_format($course->price)}} VND</td>
                                    <td>{{ $course->price_sale !== null ? number_format($course->price_sale) : '...'}}</td>
                                    <td>{{ $course->exam ? $course->exam->name : 'Chưa chọn' }}</td>
                                    <td>{{ $course->examTest ? $course->examTest->name : 'Chưa chọn' }}</td>
                                    <td>{{ $course->profession ? $course->profession->name : 'Chưa chọn' }}</td>
                                    <td>
                                        <a class="btn btn-circle btn-sm btn-info" href="{{ route('ad.course.get_feedback', $course) }}" title="Đánh giá của học viên"><i class="fa fa-comment" aria-hidden="true"></i></a>
                                        <a class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.courses.edit', $course) }}" title="Chỉnh sửa khóa học"><i class="fa fa-pencil"></i></a>
                                        <form action="{{ route('ad.course.status', $course) }}"  style="display: inline-block" method="POST" >
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-circle btn-sm {{ $course->status == 0 ? 'btn-primary' : 'btn-info'}}" title="{{ $course->status == 0 ? 'Khóa học đang ẩn' : 'Khóa học đang hiện'}}">
                                                <i class="fa {{ $course->status == 0 ? 'fa-eye-slash' : 'fa-eye'}}"></i>
                                            </button>
                                        </form>
                                        {{-- <form action="{{ route('ad.courses.destroy', $course) }}"  style="display: inline-block" method="POST" onsubmit="deleteRecord()">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-circle btn-sm btn-danger" title="Xóa khóa học"><i class="fa fa-trash"></i></button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $courses->links() }}
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
