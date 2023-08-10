@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Thêm mới đánh giá')
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
                        <a class="btn btn-circle btn-default" href="{{ route('ad.feedback.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.feedback.store') }}" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <label for="name">Tên <span class="required">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Nhập tên khách hàng...." v-validate="'required'" data-vv-as="&quot;Tên&quot;" value="{{ old('name') }}">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="avatar">Avatar<span class="required">*</span></label>
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
                                                    <input type="file" accept="image/*" name="avatar">
                                                </span>
                                                <a href="javascript:void(0);" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" :class="[errors.has('position') ? 'has-error' : '']">
                                    <label for="position">Chức vụ <span class="required">*</span></label>
                                    <input type="text" id="position" class="form-control" name="position" placeholder="Nhập chức vu...." v-validate="'required'" data-vv-as="&quot;Chức vụ&quot;" value="{{ old('position') }}">
                                    <span class="help-block" v-if="errors.has('position')">@{{ errors.first('position') }}</span>
                                </div>
                                
                                <div class="form-group" :class="[errors.has('position_type') ? 'has-error' : '']">
                                    <label for="position_type">Vị trí<span class="required">*</span></label>
                                    <select class="form-control" id="position_type" name="position_type" value="{{ old('position_type')}}">
                                        <option value="1"> Học viên </option>
                                        <option value="2" selected> Đối tác </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status">Trạng thái<span class="required">*</span></label>
                                    <select class="form-control" id="status" name="status" value="{{ old('status')}}">
                                        <option value="0"> Ẩn </option>
                                        <option value="1"> Hiện </option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label for="content">Nội dung <span class="required">*</span></label>
                                    <textarea id="content" class="form-control" name="content" >{{ old('content') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Tạo mới</button>
                            <a href="{{ route('ad.feedback.index') }}" class="btn btn-default">Quay lại</a>
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

