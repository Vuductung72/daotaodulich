@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Cập nhật banner')
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
                        <a class="btn btn-circle btn-default" href="{{ route('ad.slider.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.slider.update', $slider) }}" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <label for="name">Tên <span class="required">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Nhập tên ...." v-validate="'required'" data-vv-as="&quot;Tên&quot;" value="{{ old('name', $slider->name) }}">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="image">Hình ảnh <span class="required">*</span></label>
                                    <div>
                                        <div class="fileinput fileinput-{{ $slider->image ? 'exists' : 'new' }}" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px;">
                                                <img class="img-responsive" src="{{ asset('images/no_image.png') }}" alt="" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="height: 200px">
                                                @if($slider->image)
                                                    <img class="img-responsive" src="{{ $slider->image }}" alt="Preview banner"/>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new">Chọn ảnh</span>
                                                    <span class="fileinput-exists">Đổi ảnh</span>
                                                    <input type="file" name="image">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="url">Đường dẫn</label>
                                    <input type="text" id="url" class="form-control" name="url" placeholder="Nhập đường dẫn...." data-vv-as="&quot;Đường dẫn&quot;" value="{{ old('url', $slider->url) }}">
                                </div>

                                <div class="form-group" :class="[errors.has('position') ? 'has-error' : '']">
                                    <label for="position">Ưu tiên hiển thị <span class="required">*</span></label>
                                    <input type="text" id="position" class="form-control" name="position" placeholder="Nhập độ ưu tiên hiện thị...." v-validate="'required'" data-vv-as="&quot;Độ ưu tiên hiện thị&quot;" value="{{ old('position', $slider->position) }}">
                                    <span class="help-block" v-if="errors.has('position')">@{{ errors.first('position') }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="type">Trạng thái </label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="{{$slider->type}}"> {{ $slider->type==0 ? 'Ẩn': 'Hiện' }}  </option>
                                        <option value="{{ $slider->type == 0 ? '1' : '0' }}"> {{ $slider->type==0 ? 'Hiện': 'Ẩn' }}  </option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('ad.slider.index') }}" class="btn btn-default">Quay lại</a>
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

