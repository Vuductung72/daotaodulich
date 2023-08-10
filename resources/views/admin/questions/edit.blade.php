@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Chỉnh sửa câu hỏi')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-default" href="{{ route('ad.question.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.question.update',$question) }}" method="POST" @submit.prevent="onSubmit" >
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <label for="name">Tên câu hỏi <span class="required">*</span></label>
                                    <input placeholder="Nhập tên câu hỏi...." type="text" id="name" class="form-control" name="name" v-validate="'required'" data-vv-as="&quot;Tên câu hỏi&quot;" value="{{ $question->name }}">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="profession_id">Ngành nghề <span class="required">*</span></label>
                                    <select name="profession_id" class="form-control" id="type">
                                            <option value="0" {{$question->profession_id == 0 ? 'selected' : ''}}>Chưa chọn</option>
                                        @foreach ($professions as $profession)
                                            <option value="{{$profession->id}}" {{ $question->profession_id == $profession->id ? 'selected' : ''}}>{{$profession->name}}</option>
                                        @endforeach
                                    </select>
                                </div>                                
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="type">Thể loại câu hỏi <span class="required">*</span></label>
                                    <select name="type" class="form-control" id="type">
                                        <option value="0" {{ !$question->type ? 'selected' : '' }}>Ôn tập</option>
                                        <option value="1" {{ $question->type ? 'selected' : '' }}>Thi</option>
                                    </select>
                                </div>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" :class="[errors.has('content') ? 'has-error' : '']">
                                    <label for="type">Nội dung<span class="required">*</span></label>
                                    <textarea placeholder="Nhập nội dung câu hỏi...." name="content" id="content" style="min-width:100%" rows="10" v-validate="'required'" data-vv-as="&quot;Nội dung&quot;">{{ $question->content }}</textarea>
                                    <span class="help-block" v-if="errors.has('content')">@{{ errors.first('content') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('ad.question.index') }}" class="btn btn-default">Quay lại</a>
                        </div>
                    </form>
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
