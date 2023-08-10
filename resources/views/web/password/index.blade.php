@extends('web.layouts.master')
@section('page_og:url',request()->url())
@section('page_title', 'Xác nhận địa chỉ Email')

@section('content')
    <div id="verify-email">
        <div class="container">
            <div class="form-verify-email">
                <form action="" method="POST" id="email-verify">
                    @csrf
                    @method('PUT')
                    <div class="form-group text-center">
                        <h4 for="verify_code">Xác thực để thay đổi mật khẩu</h4>
                        <small>(Mã xác thực được gửi vào email mà bạn điền trong ô nhập)</small>
                        <input type="" name="email" id="email" class="form-control" placeholder="Nhập địa chỉ email của bạn..." value="">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-accuracy">Gửi mã xác xác thực</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
