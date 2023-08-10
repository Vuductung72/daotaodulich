<div class="text-center">
    <p>Kính gửi quý khách {{$user->name}} </p>
    <p>ATM xin chào Quý khách!</p>
    <p>Bạn đã yêu cầu đặt lại mật khẩu cho tài khoản của bạn trên <a href="{{route('w.home')}}">{{route('w.home')}}</a>.</p>
    <p>Nếu bạn không thực hiện yêu cầu này, bạn có thể yên tâm bỏ qua email này.</p>
    <p>Nếu bạn muốn thực hiện đặt lại mật khẩu hãy nhấp vào liên kết bên dưới để hoàn tất quy trình. <a href="{{route('w.get_pass', ['user'=> $user , 'token' => $user->token])}}" class='btn btn-primary'>Nhấn vào đây để thay đổi mật khẩu mới!</a></p>
    <p>Trân Trọng,</p>
    <p>Đội ngũ ATM.</p>
</div>
