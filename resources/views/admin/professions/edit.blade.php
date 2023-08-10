@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Chỉnh sửa ngành')
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
                        <a class="btn btn-circle btn-default" href="{{ route('ad.profession.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.profession.update',$profession) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group" :class="[errors.has('profession_code') ? 'has-error' : '']">
                                    <input placeholder="Nhập mã ngành...." type="text" id="profession_code" class="form-control" name="profession_code" v-validate="'required'" data-vv-as="&quot;Mã ngành&quot;" value="{{ $profession->profession_code }}">
                                    <span class="help-block" v-if="errors.has('profession_code')">@{{ errors.first('profession_code') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <input placeholder="Nhập tên ngành...." type="text" id="name" class="form-control" name="name" v-validate="'required'" data-vv-as="&quot;Tên ngành&quot;" value="{{ $profession->name }}">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="form-control" name="status" id="status">
                                        <option value="1" {{ $profession->status == 1 ? 'selected' : ''}}>Hiện</option>
                                        <option value="0" {{ $profession->status == 0 ? 'selected' : ''}}>Ẩn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="w-100 btn btn-primary">Cập nhật</button>                  
                                </div>  
                            </div>
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
