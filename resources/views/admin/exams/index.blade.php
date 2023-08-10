@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý bộ đề thi')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a href="{{ route('ad.exam.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Thêm mới</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-title">
                    <form action="{{ route('ad.exam.search') }}" method="GET">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input placeholder="Nhập tên bộ đề thi cần tìm...." type="text" name="name" class="form-control" value="{{ old('name') }}" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="w-100 btn btn-primary form-control" type="submit">Tìm kiếm</button>
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
                            <th>Tên bộ đề</th>
                            <th>Khoá học</th>
                            <th>Ngành nghề</th>
                            <th>Số câu hỏi</th>
                            <th>Số câu bắt buộc đúng</th>
                            <th>Thời gian thi (phút)</th>
                            <th>Lệ phí thi lại (vnđ)</th>
                            <th>Loại đề</th>
                            <th width='120'>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <td>{{ $loop->index +1 }}</td>
                                    <td>{{ $exam->name }}</td>
                                    <td>{{ $exam->course ? $exam->course->name : '....'  }}</td>
                                    <td>{{ $exam->profession ? $exam->profession->name : 'Chưa chọn' }}</td>
                                    <td>{{ $exam->examQuestions->count() }}</td>
                                    <td>{{ $exam->number_pass }}</td>
                                    <td>{{ $exam->time }}</td>
                                    <td>{{ number_format($exam->money, 0, ',', '.')}}</td>
                                    <td>{{ $exam->type == 1 ? 'Thi thật' : 'Thi thử' }}</td>
                                    <td>
                                        <a class="btn btn-circle btn-sm btn-info" href="{{ route('ad.exam.show', $exam) }}" title="Xem chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                        <form action="{{ route('ad.exam.status', $exam) }}"  style="display: inline-block" method="POST" >
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-circle btn-sm {{ $exam->status == 0 ? 'bg-secondary' : 'bg-primary'}}" title="{{ $exam->status == 0 ? 'Bài thi đang ẩn' : 'Bài thi đang hiện'}}">
                                                <i class="fa {{ $exam->status == 0 ? 'fa-eye-slash' : 'fa-eye'}}"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $exams->links() }}
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
