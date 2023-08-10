@extends('admin.layouts.master')

@section('page_title', 'Tạo mới CMS')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">@yield('page_title')</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-default" href="{{ route('ad.cms.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.cms.store') }}" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <label for="name">Tiêu đề <span class="required">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name" v-validate="'required'" data-vv-as="&quot;Tiêu đề&quot;" value="{{ old('name') }}">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>
                                <div class="form-group" >
                                    <label for="content">Nội dung <span class="required">*</span></label>
                                    <textarea  type="text" id="content" class="form-control tinymce" name="content" >{!! old('content') !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" >
                                    <label for="keywords">Keywords</label>
                                    <input type="text" id="keywords" class="form-control" name="keywords"  value="{{ old('keywords') }}">
                                </div>
                                <div class="form-group">
                                    <label for="image">Hình ảnh <span class="required">*</span></label>
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px;">
                                                <img class="img-responsive" src="{{ asset('images/no_image.png') }}" alt="" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="height: 200px"></div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new">Chọn ảnh</span>
                                                    <span class="fileinput-exists">Đổi ảnh</span>
                                                    <input type="file" accept="image/*" name="image">
                                                </span>
                                                <a href="javascript:void(0);" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" :class="[errors.has('description') ? 'has-error' : '']">
                                    <label for="description">Mô tả <span class="required">*</span></label>
                                    <textarea  type="text" id="description" class="form-control" name="description" v-validate="'required'" data-vv-as="&quot;Mô tả&quot;">{{ old('description') }}</textarea>
                                    <span class="help-block" v-if="errors.has('description')">@{{ errors.first('description') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Tạo mới</button>
                            <a href="{{ route('ad.cms.index') }}" class="btn btn-default">Quay lại</a>
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

