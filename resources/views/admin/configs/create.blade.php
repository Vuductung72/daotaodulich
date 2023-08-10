@extends('admin.layouts.master')

@section('page_title', 'Tạo mới cấu hình')

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
                        <a class="btn btn-circle btn-default" href="{{ route('ad.config.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.config.store') }}" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="[errors.has('key') ? 'has-error' : '']">
                                    <label for="key">Key <span class="required">*</span></label>
                                    <input type="text" id="key" class="form-control" name="key" v-validate="'required'" data-vv-as="&quot;Key&quot;" value="{{ old('key') }}">
                                    <span class="help-block" v-if="errors.has('key')">@{{ errors.first('key') }}</span>
                                </div>
                                <div class="form-group" :class="[errors.has('value') ? 'has-error' : '']">
                                    <label for="value">Value <span class="required">*</span></label>
                                    <textarea class="form-control" name="value" id="value" cols="30" rows="10" v-validate="'required'" data-vv-as="&quot;Value&quot;">{{ old('value') }}</textarea>
                                    <span class="help-block" v-if="errors.has('value')">@{{ errors.first('value') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Tạo mới</button>
                            <a href="{{ route('ad.config.index') }}" class="btn btn-default">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
@endpush

@prepend('scripts')
@endprepend

