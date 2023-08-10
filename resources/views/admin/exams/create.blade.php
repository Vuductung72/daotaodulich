@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Thêm bộ đề thi mới')
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
                        <a class="btn btn-circle btn-default" href="{{ route('ad.exam.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.exam.store') }}" method="POST" @submit.prevent="onSubmit">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <label for="name">Tên bộ đề <span class="required">*</span></label>
                                    <input placeholder="Nhập tên bộ đề...." type="text" id="name" class="form-control" name="name" v-validate="'required'" data-vv-as="&quot;Tên bộ đề&quot;" value="{{ old('name') }}">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="type">Loại đề thi <span class="required">*</span></label>
                                    <select name="type" class="form-control" id="type">
                                        <option value="0">Thi thử</option>
                                        <option value="1">Thi thật</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="profession_id">Ngành nghề <span class="required">*</span></label>
                                    <select name="profession_id" class="form-control" id="type">
                                        <option value="">Chưa chọn</option>
                                        @foreach ($professions as $profession)
                                            <option value="{{$profession->id}}">{{$profession->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group" :class="[errors.has('number') ? 'has-error' : '']">
                                    <label for="number">Số câu <span class="required">*</span></label>
                                    <input placeholder="Nhập số lượng câu...." type="number" min="1" id="number" class="form-control" name="number" v-validate="'required'" data-vv-as="&quot;Số câu&quot;" value="{{ old('number') }}">
                                    <span class="help-block" v-if="errors.has('number')">@{{ errors.first('number') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" :class="[errors.has('number_pass') ? 'has-error' : '']">
                                    <label for="number_pass">Số câu bắt buộc đúng <span class="required">*</span></label>
                                    <input placeholder="Nhập số lượng câu...." type="number" min="1" id="number_pass" class="form-control" name="number_pass" v-validate="'required'" data-vv-as="&quot;Số câu bắt buộc đúng&quot;" value="{{ old('number_pass') }}">
                                    <span class="help-block" v-if="errors.has('number_pass')">@{{ errors.first('number_pass') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" :class="[errors.has('time') ? 'has-error' : '']">
                                    <label for="time">Thời gian thi (phút) <span class="required">*</span></label>
                                    <input placeholder="Nhập thời gian thi...." type="number" min="1" id="time" class="form-control" name="time" v-validate="'required'" data-vv-as="&quot;Thời gian thi&quot;" value="{{ old('time') }}">
                                    <span class="help-block" v-if="errors.has('time')">@{{ errors.first('time') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" :class="[errors.has('money') ? 'has-error' : '']">
                                    <label for="money">Lệ phí lại (vnđ) <span class="required">*</span></label>
                                    <input placeholder="Nhập số tiền...." type="number" min="1" id="money" class="form-control" name="money" v-validate="'required'" data-vv-as="&quot;Lệ phí lại&quot;" value="{{ old('money') }}">
                                    <span class="help-block" v-if="errors.has('money')">@{{ errors.first('money') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="course_id">Khoá học<span class="required">*</span></label>
                                    <select name="course_id" class="form-control" id="type">
                                        <option value="">Chưa chọn</option>
                                        @foreach ($courses as $course)
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Thêm</button>
                            <a href="{{ route('ad.exam.index') }}" class="btn btn-default">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
<link href="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endpush

@prepend('scripts')
<script src="{{ asset('global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@include('admin.lib.tinymce-setup')

@endprepend

