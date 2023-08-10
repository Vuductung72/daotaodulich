@extends('admin.layouts.master')

@section('page_title', 'Cập nhật Cấu hình')

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
                        <a class="btn btn-circle btn-default" href="{{ route('ad.config.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.config.update', $config) }}" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="key">Key <span class="required">*</span></label>
                                    <input type="text" id="key" class="form-control" name="key" value="{{ old('key', $config->key) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="[errors.has('value') ? 'has-error' : '']">
                                    <label for="value">Value <span class="required">*</span></label>
                                    <input type="text" name="value" id="value" class="form-control"  v-validate="'required'" data-vv-as="&quot;Value&quot;" value="{{ old('value', $config->value) }}">
                                    <span class="help-block" v-if="errors.has('value')">@{{ errors.first('value') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Cập nhật</button>
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
