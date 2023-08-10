@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Cập nhật danh mục')
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
                        <a class="btn btn-circle btn-default" href="{{ route('ad.category.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.category.update', $category) }}" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                    @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <label for="name">Tên <span class="required">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name" v-validate="'required'" data-vv-as="&quot;Tên&quot;" value="{{ old('name', $category->name) }}" placeholder="Nhập tên....">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="position">Vị trí</label>
                                    <input type="number" id="position" class="form-control" name="position" value="{{ $category->position }}" placeholder="Nhập vị trí....">
                                </div>
                                <div class="form-group">
                                    <label for="type">Dạng danh mục </label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="{{$category->type}}"> {{ $category->type==0 ? 'Tin tức': 'Điều khoản dịch vụ' }}  </option>
                                        <option value="{{ $category->type == 0 ? '1' : '0' }}"> {{ $category->type==0 ? 'Điều khoản dịch vụ': 'Tin tức' }}  </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="image">Hình ảnh <span class="required">*</span></label>
                                        <div>
                                            <div class="fileinput fileinput-{{ $category->image ? 'exists' : 'new' }}" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 100px;">
                                                    <img class="img-responsive" src="{{ asset('images/no_image.png') }}" alt="" />
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="height: 100px">
                                                    @if($category->image)
                                                        <img class="img-responsive" src="{{ $category->image }}" alt="Preview banner"/>
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
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="description">Mô tả ngắn</label>
                                    <textarea rows="10" id="description" class="form-control" name="description" placeholder="Nhập mô tả ngắn....">{{ $category->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('ad.category.index') }}" class="btn btn-default">Quay lại</a>
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
@endprepend
