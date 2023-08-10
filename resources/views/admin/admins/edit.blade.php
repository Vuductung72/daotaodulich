@extends('admin.layouts.master')
@section('page_og:url', request()->url())
@section('page_title', 'Chỉnh sửa Admin')
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
                        <a class="btn btn-circle btn-default" href="{{ route('ad.admin.index') }}" title="">Quay lại</a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:void(0);" title="Toàn màn hình"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="{{ route('ad.admin.update', $admin) }}" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="[errors.has('name') ? 'has-error' : '']">
                                    <label for="name">Tên <span class="required">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Nhập tên tài khoản...." v-validate="'required'" data-vv-as="&quot;Tên&quot;" value="{{ old('name', $admin->name) }}">
                                    <span class="help-block" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="required">*</span></label>
                                    <input name="email" type="text" id="email" class="form-control" placeholder="Nhập email...."  value="{{ old('email', $admin->email) }}">
                                </div>
                                <div class="form-group" :class="[errors.has('phone') ? 'has-error' : '']">
                                    <label for="phone">Số điện thoại <span class="required">*</span></label>
                                    <input type="text" id="phone" class="form-control" name="phone" placeholder="Nhập số điện thoại...." v-validate="'required'" data-vv-as="&quot;SĐT&quot;" value="{{ old('phone', $admin->phone) }}">
                                    <span class="help-block" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu </label>
                                    <input type="text" id="password" class="form-control" name="password" placeholder="Nhập mật khẩu...."  value="{{ old('password') }}">
                                </div>
                                <div class="form-group">
                                    <label for="role">Vai trò</label>
                                    <select class="form-control" name="role" id="role">
                                        <option value="2" {{ $admin->role == 2 ? 'selected' : '' }}>Biên tập viên</option>
                                        <option value="1" {{ $admin->role == 1 ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('ad.admin.index') }}" class="btn btn-default">Quay lại</a>
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
