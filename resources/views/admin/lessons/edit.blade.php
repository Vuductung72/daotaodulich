@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Chỉnh sửa bài học')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i aria-hidden="true" class="fa fa-plus-circle"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-default" href="{{ route('ad.lesson.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.lesson.update',$lesson) }}" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <label for="name">Tên bài học <span class="required">*</span></label>
                                    <input type="hidden" class="form-control" name="id" value="{{ $lesson->id }}">
                                    <input type="text" id="name" class="form-control" name="name" v-validate="'required'" data-vv-as="&quot;Tên khóa học&quot;" value="{{ $lesson->name }}" placeholder="Nhập tên khóa học....">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>
                                <div class="form-group" :class="[errors.has('order') ? 'has-error' : '']">
                                    <label for="order">Vị trí<span class="required">*</span></label>
                                    <input type="number" id="order" class="form-control" min="1" name="order" v-validate="'required'" data-vv-as="&quot;Vị trí&quot;" value="{{ $lesson->order }}" placeholder="Nhập vị trí....">
                                    <span class="help-block" v-if="errors.has('order')">@{{ errors.first('order') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="course_id">Thuộc khóa học</label>
                                    <select class="form-control" name="course_id" id="course_id">
                                        @foreach ($courses as $course)
                                            <option value="{{$course->id}}" {{ $lesson->course_id == $course->id ? 'selected' : ''}}>{{$course->name}}</option>                                            
                                            @endforeach
                                        </select>
                                    </div>        
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thumb">Ảnh đại diện <span class="required">*</span></label>
                                        <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width:150px">
                                                <img class="img-responsive" src="{{ asset($lesson->thumb) }}" alt="" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width:150px"></div>
                                            <div class="">
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new">Chọn ảnh</span>
                                                    <span class="fileinput-exists">Đổi ảnh</span>
                                                    <input type="file" accept="image/*" name="thumb">
                                                </span>
                                                {{-- <a href="javascript:void(0);" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Xóa</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                @if ($lesson->audio)
                                    <div class="form-group" >
                                        <label>Audio </label>
                                        <audio controls style="width: 100%;">
                                            <source src="{{asset($lesson->audio)}}" type="audio/mpeg">
                                        </audio>
                                    </div>                                    
                                @endif
                                <div class="form-group" >
                                    <label for="audio">Nhập file audio mới </label>
                                    <input type="file" class="form-control" name="audio" id="audio" >
                                </div>
                                <div class="form-group" >
                                    <label for="content">Nội dung <span class="required">*</span></label>
                                    <textarea  type="text" id="content" class="form-control tinymce" name="content">{!! $lesson->content !!}</textarea>
                                </div>                                
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('ad.lesson.index') }}" class="btn btn-default">Quay lại</a>
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