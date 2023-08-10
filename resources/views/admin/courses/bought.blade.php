@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Lịch sử đăng ký khóa học')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-history" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        {{-- <a href="{{ route('ad.course_buyss.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Thêm mới</a> --}}
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-title">
                    <form action="{{route('ad.course.bought-search')}}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="startDate">Từ</label>
                                    <input type="date" name="startDate" class="form-control" value="{{ old('startDate', $startDate ?? '') }}" id="startDate">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="endDate">Đến</label>
                                    <input type="date" name="endDate" class="form-control" value="{{ old('endDate', $endDate ?? '') }}" id="endDate">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="" style="">&nbsp;</label>
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
                                <th width="110">Ngành nghề</th>
                                <th>Giá (vnđ)</th>
                                <th>Giá khuyến mãi (vnđ)</th>
                                <th>Tên học viên</th>
                                <th>Thời gian đăng ký</th>
                                {{-- <th width="150">Thao tác</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course_buys as $course_buy)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td><img src="{{ $course_buy->course->thumb }}" style="max-width: 40px" alt=""></td>
                                    <td>{{ $course_buy->course->name }}</td>
                                    <td>{{ $course_buy->course->profession->name }}</td>
                                    <td>{{ $course_buy->course->price ? number_format($course_buy->course->price) : '...'}}</td>
                                    <td>{{ $course_buy->course->price_sale ? number_format($course_buy->course->price_sale) : '...'}}</td>
                                    <td>{{ $course_buy->user->name }}</td>
                                    <td >{{ \Carbon\Carbon::createFromDate($course_buy->created_at)->format('H:i:s | d-m-Y') }}</td>

                                    {{-- <td>
                                        <a class="btn btn-circle btn-sm btn-info" href="{{ route('ad.course_buys.get_feedback', $course_buy) }}" title="Đánh giá của học viên"><i class="fa fa-comment" aria-hidden="true"></i></a>
                                        <a class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.course_buyss.edit', $course_buy) }}" title="Chỉnh sửa khóa học"><i class="fa fa-pencil"></i></a>
                                        <form action="{{ route('ad.course_buyss.destroy', $course_buy) }}"  style="display: inline-block" method="POST" onsubmit="deleteRecord()">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-circle btn-sm btn-danger" title="Xóa khóa học"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $course_buys->links() }}
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
