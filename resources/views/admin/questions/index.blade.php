@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý câu hỏi')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    {{-- <div class="caption">
                        
                    </div> --}}
                    <div class="actions">
                        <form action="{{route('ad.question.export_question')}}" method="GET" style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="profession_id" class="form-control" value="{{ old('profession_id', request()->input('profession_id') ?? 0) }}" >
                            <button class="btn btn-circle btn-sm btn-primary" id="btnExportExcel"> <i class="fa fa-download" aria-hidden="true"></i> Xuất Excel</button>
                        </form>
                        <a href="{{ route('ad.question.create') }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Thêm mới</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-title">
                    <form action="{{ route('ad.question.search') }}" method="GET">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="name" class="form-control">Ngành nghề:</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select class="form-control" name="profession_id">                                          
                                        <option value="0" selected>Tất cả</option>                                            
                                        @foreach ($professions as $profession)
                                            <option value="{{$profession->id}}" {{ request()->input('profession_id') == $profession->id ? 'selected' : ''}}>{{ $profession->name}}</option>                                            
                                        @endforeach
                                    </select>
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
                <div class="portlet-body" style="background: #fff">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th width="150">Tên câu hỏi</th>
                            <th>Nội dung</th>
                            <th width="150">Ngành nghề</th>
                            <th width="100">Thể loại</th>
                            <th width="110">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $question->name }}</td>
                                <td>{{ $question->content }}</td>
                                <td>{{ $question->profession ?  $question->profession->name : 'Chưa chọn'}}</td>
                                <td>{{ $question->type ? 'Thi' : 'Ôn tập'}}</td>
                                <td>
                                    <a class="btn btn-circle btn-sm btn-info" href="{{ route('ad.question.show', $question) }}" title="Câu trả lời"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                    <a class="btn btn-circle btn-sm btn-warning" href="{{ route('ad.question.edit', $question) }}" title="Chỉnh sửa câu hỏi"><i class="fa fa-pencil"></i></a>
                                    <form action="{{ route('ad.question.status', $question) }}"  style="display: inline-block" method="POST" >
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-circle btn-sm {{ $question->status == 0 ? 'bg-secondary' : 'bg-primary'}}" title="{{ $question->status == 0 ? 'Câu hỏi đang ẩn' : 'Câu hỏi đang hiện'}}">
                                            <i class="fa {{ $question->status == 0 ? 'fa-eye-slash' : 'fa-eye'}}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('ad.question.destroy', $question) }}" style="display: inline-block" method="POST" onsubmit="deleteRecord()">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-circle btn-sm btn-danger" title="Xóa câu hỏi" ><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $questions->links() }}
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
