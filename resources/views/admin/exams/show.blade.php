@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Danh sách các câu hỏi của bộ đề "'.$exam->name.'"')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a href="{{ route('ad.exam.edit',$exam) }}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-plus"></i> Thêm câu hỏi</a>
                        <a class="btn btn-circle btn-default" href="{{ route('ad.exam.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title=""></a>
                    </div>
                </div>
                <div class="portlet-body" style="background: #fff">
                    @if ($exam_questions->count())
                        <table class="table table-striped table-bordered table-hover" id="admin-table">
                            <thead>
                                <tr>
                                    <th width="100">STT</th>
                                    <th width="200">Tên câu hỏi</th>
                                    <th>Nội dung</th>
                                    <th width="100">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exam_questions as $exam_question)
                                    <tr>
                                        <td>{{ $loop->index +1 }}</td>
                                        <td>{{ $exam_question->question->name }}</td>
                                        <td>{{ $exam_question->question->content }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-circle btn-sm btn-info" href="{{ route('ad.question.show', $exam_question->question) }}" title="Câu trả lời"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                            <form action="{{ route('ad.exam-question.delete',$exam_question->id) }}"  style="display: inline-block" method="POST" onsubmit="deleteRecord()">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-circle btn-sm btn-danger " title="Xóa câu hỏi"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- {{dd($exam_questions->toArray())}} --}}
                            </tbody>
                        </table>                        
                    @else
                        <h4 class="text-center">Chưa có câu hỏi</h4> 
                    @endif
                    {{-- <div class="text-center">
                        {{ $exam_questions->links('web.layouts.paginate') }}
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
