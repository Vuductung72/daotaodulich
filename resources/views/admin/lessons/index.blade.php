@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý bài học')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-text-o" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a href="{{ route('ad.lesson.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Thêm mới</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-title">
                    <form action="{{ route('ad.lesson.search') }}" method="GET">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="lesson" class="form-control" value="{{ old('lesson') }}" id="exampleInputEmail1" placeholder="Nhập tên bài học cần tìm....">
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
                                <th>Tên bài học</th>
                                <th>Khóa học</th>
                                <th>Vị trí</th>
                                <th width="150">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessons as $lesson)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td><img src="{{ $lesson->thumb }}" style="max-width: 40px" alt=""></td>
                                    <td>{{ $lesson->name }}</td>
                                    <td>{{ $lesson->course->name}}</td>
                                    <td>{{ $lesson->order}}</td>
                                    <td>
                                        <a class="btn btn-circle btn-sm btn-info" href="{{ route('ad.lesson.show', $lesson) }}" title="Xem chi tiết"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                        <a class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.lesson.edit', $lesson) }}"><i class="fa fa-pencil"></i></a>
                                        <form action="{{ route('ad.lesson.status', $lesson) }}"  style="display: inline-block" method="POST" >
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-circle btn-sm {{ $lesson->status === 0 ? 'bg-secondary' : 'bg-primary'}}" title="{{ $lesson->status === 0 ? 'Bài học đang ẩn' : 'Bài học đang hiện'}}">
                                                <i class="fa {{ $lesson->status === 0 ? 'fa-eye-slash' : 'fa-eye'}}"></i>
                                            </button>
                                        </form>
                                        {{-- <form action="{{ route('ad.lesson.destroy', $lesson) }}"  style="display: inline-block" method="POST" onsubmit="deleteRecord()">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-circle btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $lessons->links() }}
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
