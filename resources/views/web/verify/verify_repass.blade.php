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
                        <h4 for="verify_code">Xác thực email</h4>
                        <small>(Mã xác thực được gửi vào email mà bạn dùng đăng kí tài khoản)</small>
                        <input type="" name="verify_code" id="verify_code" class="form-control" placeholder="Nhập mã..." value="">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-accuracy">Xác thực</button>
                        <button type="button" class="btn btn-danger btn-verification-code" data-url="" disabled>Gửi mã xác thực</button>
                        <div class="timeout">
                            <p>Bạn có thể yêu cầu gửi lại mã xác nhận sau <span id="countdown">60</span>s</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".btn-verification-code").click(function (e) {
                var url = $(this).data('url');
                window.location.href = url;
            });

        // Sau 60 giây, bỏ thuộc tính disabled khỏi button
            setTimeout(function() {
                $(".btn-verification-code").prop('disabled', false);
            }, 60000); // 60 giây

            /* tính thời gian kết thúc */
            var countdown = $('#countdown');
            // Thiết lập thời gian đích
            var endTime = new Date().getTime() + 60000; // Thời gian hiện tại + 60 giây
            // Cập nhật thời gian đếm ngược mỗi giây
            var countdownInterval = setInterval(function() {
                // Lấy thời gian hiện tại
                var now = new Date().getTime();
                // Tính thời gian còn lại
                var timeLeft = endTime - now;
                // Tính số giây còn lại
                var secondsLeft = Math.floor(timeLeft / 1000);
                // Hiển thị số giây còn lại
                countdown.text(secondsLeft);
                // Nếu đã hết thời gian đếm ngược, dừng cập nhật
                if (timeLeft < 0) {
                    clearInterval(countdownInterval);
                    countdown.text('0');
                    $('.timeout').hide();
                }
            }, 1000); // 1 giây
        });
    </script>
@endpush
