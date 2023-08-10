@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Thêm câu hỏi cho bài học')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        @if ($list_question->toArray())
                            <button type="submit" form="formAddNew" class="btn btn-circle btn-sm btn-primary" title="Xác nhận thêm câu hỏi">Thêm</button>                            
                        @endif
                        <a class="btn btn-circle btn-default" href="{{ route('ad.lesson.show',$lesson) }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    @if ($list_question->count())
                        <form action="{{ route('ad.lesson-question.update',$lesson) }}" method="POST" id="formAddNew" @submit.prevent="onSubmit">
                            @csrf
                            @method('PUT')
                            <table class="table table-striped table-bordered table-hover" id="admin-table">
                                <thead>
                                    <tr>
                                        <th width="40">STT</th>
                                        <th width="200">Tên câu hỏi</th>
                                        <th>Nội dung</th>
                                        <th width="50">Chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_question as $question)
                                        <tr>
                                            <td>{{ $loop->index +1 }}</td>
                                            <td>{{ $question->name }}</td>
                                            <td>{{ $question->content }}</td>
                                            <td class="text-center">
                                                <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="id[]"  value="{{ $question->id }}">
                                                </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>                        
                    @else
                        <h4 class="text-center">Ngân hàng câu hỏi không có câu hỏi phù hợp!</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}"/>

@endpush

@prepend('scripts')
<script src="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('admin.lib.tinymce-setup')

@endprepend


