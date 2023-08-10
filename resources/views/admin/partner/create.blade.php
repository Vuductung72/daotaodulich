@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Thêm mới đối tác')
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
                        <a class="btn btn-circle btn-default" href="{{ route('ad.partner.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.partner.store') }}" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <label for="name">Tên đối tác <span class="required">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Nhập tên đối tác...." v-validate="'required'" data-vv-as="&quot;Tên&quot;" value="{{ old('name') }}">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="image">Hình ảnh<span class="required">*</span></label>
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

                                <div class="form-group" :class="[errors.has('email') ? 'has-error' : '']">
                                    <label for="email">Email đối tác <span class="required">*</span></label>
                                    <input type="text" id="email" class="form-control" name="email" placeholder="Nhập email đối tác...." v-validate="'required'" data-vv-as="&quot;Email&quot;" value="{{ old('email') }}">
                                    <span class="help-block" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                                </div>

                                <div class="form-group" :class="[errors.has('phone') ? 'has-error' : '']">
                                    <label for="phone">Số điện thoại đối tác <span class="required">*</span></label>
                                    <input type="text" id="phone" class="form-control" name="phone" placeholder="Nhập số điện thoại đối tác...." v-validate="'required'" data-vv-as="&quot;Số điện thoại&quot;" value="{{ old('phone') }}">
                                    <span class="help-block" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                                </div>

                                <div class="form-group" :class="[errors.has('address') ? 'has-error' : '']">
                                    <label for="address">Địa chỉ đối tác <span class="required">*</span></label>
                                    <input type="text" id="address" class="form-control" name="address" placeholder="Nhập địa chỉ đối tác...." v-validate="'required'" data-vv-as="&quot;Địa chỉ&quot;" value="{{ old('address') }}">
                                    <span class="help-block" v-if="errors.has('address')">@{{ errors.first('address') }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="url">Đường dẫn</label>
                                    <input type="text" id="url" class="form-control" name="url" placeholder="Nhập đường dẫn...." data-vv-as="&quot;Đường dẫn&quot;" value="{{ old('url') }}">
                                </div>
                                
                            </div>

                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label for="content">Ghi chú <span class="required">*</span></label>
                                    <textarea id="description" class="form-control tinymce" name="description" >{!! old('description') !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Tạo mới</button>
                            <a href="{{ route('ad.partner.index') }}" class="btn btn-default">Quay lại</a>
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
