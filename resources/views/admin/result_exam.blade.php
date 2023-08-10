@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Quản lý kết quả thi')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-datatable bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        {{-- <form action="{{route('ad.question.export_question')}}" method="GET">
                            @csrf
                            <input type="hidden" name="profession_id" class="form-control" value="{{ old('profession_id', request()->input('profession_id') ?? 0) }}" >
                            <button class="btn btn-circle btn-sm btn-primary" id="btnExportExcel"> <i class="fa fa-download" aria-hidden="true"></i> Xuất Excel</button>
                        </form> --}}
                        <a href="{{route('ad.exam.export_result')}}" class="btn btn-circle btn-sm btn-primary"> <i class="fa fa-download" aria-hidden="true"></i> Xuất Excel</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="admin-table">
                        <thead>
                            <tr>
                                <th width="40">STT</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Tên khóa học</th>
                                <th>Thể loại</th>
                                <th>Kết quả</th>
                                <th>Trạng thái</th>
                                <th>Ngày thi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{ $loop->index +1}}</td>
                                    <td>{{ $result->user->name }}</td>
                                    <td>{{ $result->user->email }}</td>
                                    <td>{{ $result->course ? $result->course->name : '...'}}</td>
                                    <td>{{ $result->type === 1 ? 'Thi thật' : 'Thi thử'}}</td>
                                    <td>
                                        @php
                                            if($result->answer != [] OR $result->answer != '' ){
                                                $arrQuestion = json_decode($result->answer,true);
                                                $numberQuestion = array_count_values($arrQuestion);
                                                $numberQuestion = isset($numberQuestion['1']) ? $numberQuestion['1'] : 0;
                                                echo $numberQuestion. '/' .$result->exam->examQuestions->count() . ' câu';
                                            }else{
                                                echo '0/' .$result->exam->examQuestions->count() . ' câu';
                                            }
                                        @endphp
                                    </td>
                                    <td>{{ $result->status ? 'Đạt' : 'Chưa đạt'}}</td>
                                    <td>{{\Carbon\Carbon::createFromDate($result->created_at)->format('d/m/Y')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
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
