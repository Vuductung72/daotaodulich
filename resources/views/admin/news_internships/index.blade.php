@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Danh sách tin thực tập')
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
                        {{-- <a href="{{ route('ad.courses.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Thêm mới</a> --}}
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-title">
                    <form action="{{ route('ad.news-internship.search') }}" method="GET">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control" value="{{ isset($internships) ? $internships : ''}}" id="title" placeholder="Nhập tiêu đề cần tìm....">
                                    {{-- {{ isset($internship) ? $internship : ''}} --}}
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
                                <th>Tiêu đề</th>
                                <th>Công ty</th>
                                <th>Ngành nghề</th>
                                <th>Trạng thái</th>
                                <th>Danh sách người ứng tuyển</th>
                                <th width="110">Thao tác</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($internships as $internship)
                            <tr>
                                <td>{{ $loop->index +1}}</td>
                                <td>{{ $internship->title }}</td>
                                <td>{{ $internship->customer->fullname }}</td>
                                <td>{{ $internship->profession->name }}</td>
                                <td>{{ $internship->status == 0 ? 'Ẩn' : 'Hiện' }}</td>
                                <td>
                                    <a href="{{route('ad.list-intern', $internship)}}">Danh sách</a>
                                </td>
                                <td>
                                    <a title="Xem tin thực tập" class="btn btn-circle btn-sm btn-warning" href="{{route('ad.news-internship.show', $internship)}}"><i class="fa fa-pencil"></i></a>
                                    <form action="{{ route('ad.news-internship.status', $internship) }}" id="delete-course-item-form" style="display: inline-block" method="POST" >
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-circle btn-sm {{ $internship->status == '0' ? 'btn-primary' : 'btn-info'}}">
                                            <i class="fa {{ $internship->status == '0' ? 'fa-eye-slash' : 'fa-eye'}}"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        {{ $internships->links() }}
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
