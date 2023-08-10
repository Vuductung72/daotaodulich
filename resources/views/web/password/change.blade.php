@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Xác nhận địa chỉ Email')

@section('content')
    <div id="verify-email">
        <div class="container">
            <div class="form-verify-email">
                <form action="{{ route('w.post.verify_password', $user) }}"
                    id="form-pasword-account" method="POST" @submit.prevent="onSubmit" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password">Mật khẩu mới:</label>
                                <div style="position: relative">
                                    <input type="password" class="form-control" placeholder="Mật khẩu mới..." id="password"  name="password">
                                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="re-password">Nhập lại mật khẩu:</label>
                                <div style="position: relative">
                                    <input type="password" class="form-control" placeholder="Nhập lại mật khẩu..." id="re-password"  name="re-password">
                                    <span toggle="#re-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
