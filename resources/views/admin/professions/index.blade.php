@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý ngành nghề')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        {{-- <a href="{{ route('ad.profession.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Tạo mới</a> --}}
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-title">
                    {{-- create new profession --}}
                    <form action="{{ route('ad.profession.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input placeholder="Nhập mã ngành...." type="text" id="profession_code" class="form-control" name="profession_code" value="{{ old('profession_code') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input placeholder="Nhập tên ngành...." type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="form-control" name="status" id="status">
                                      <option value="1">Hiện</option>
                                      <option value="0">Ẩn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="w-100 btn btn-primary">Thêm mới</button>                  
                                </div>  
                            </div>
                        </div>
                    </form>
                </div>
                <div class="portlet-body" style="background: #fff">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                        <thead>
                        <tr>
                            <th width="40">STT</th>
                            <th width="120">Mã ngành</th>
                            <th>Tên ngành</th>
                            <th width="120">Trạng thái</th>
                            <th width="80">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($professions as $profession)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $profession->profession_code }}</td>
                                <td>{{ $profession->name }}</td>
                                <td>{{ $profession->status == 1 ? 'Hiện' : 'Ẩn' }}</td>
                                <td>
                                    <a class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.profession.edit', $profession) }}" title="Chỉnh sửa ngành"><i class="fa fa-pencil"></i></a>
                                    {{-- <form action="{{ route('ad.profession.destroy', $profession->id) }}" style="display: inline-block" method="POST" onsubmit="deleteRecord()">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-circle btn-sm btn-danger" title="Xóa câu hỏi"><i class="fa fa-trash"></i></button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $professions->links('web.layouts.paginate') }}
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
