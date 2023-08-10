@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Cập nhật bài viết')
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
                        <a class="btn btn-circle btn-default" href="{{ route('ad.blog.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.blog.update', $blog) }}" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <label for="name">Tiêu đề <span class="required">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name" v-validate="'required'" data-vv-as="&quot;Tiêu đề&quot;" value="{{ old('name', $blog->name) }}">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Danh mục <span class="required">*</span></label>
                                    <select name="category_id" class="form-control" id="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="type">Dạng danh mục </label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="{{$blog->type}}"> {{ $blog->type==0 ? 'Tin tức': 'Điều khoản dịch vụ' }}  </option>
                                        <option value="{{ $blog->type == 0 ? '1' : '0' }}"> {{ $blog->type==0 ? 'Điều khoản dịch vụ': 'Tin tức' }}  </option>
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <label for="keyword">Keywords</label>
                                    <input type="text" id="keyword" class="form-control" name="keyword"  value="{{ $blog->keyword }}">
                                </div>
                                <div class="form-group" :class="[errors.has('description') ? 'has-error' : '']">
                                    <label for="description">Mô tả</label>
                                    <textarea  type="text" id="description" class="form-control" name="description">{{ $blog->description }}</textarea>                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Hình ảnh <span class="required">*</span></label>
                                    <div>
                                        <div class="fileinput fileinput-{{ $blog->image ? 'exists' : 'new' }}" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px;">
                                                <img class="img-responsive" src="{{ asset('images/no_image.png') }}" alt="" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="height: 200px">
                                                @if($blog->image)
                                                    <img class="img-responsive" src="{{ $blog->image }}" alt="Preview banner"/>
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
                            <div class="col-md-12">
                                <div class="form-group" >
                                    <label for="content">Nội dung <span class="required">*</span></label>
                                    <textarea  type="text" id="content" class="form-control tinymce" name="content">{!! old('content', $blog->content) !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('ad.blog.index') }}" class="btn btn-default">Quay lại</a>
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
