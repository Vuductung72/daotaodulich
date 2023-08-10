<!-- footer -->
<footer>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-3">
                    <div class="footer-logo">
                        <img src="{{ asset(config('constant.logo_footer')) }}" alt="">
                    </div>
                    <ul class="list">
                        <li><a href="https://www.google.com/maps/place/210+L%C3%BD+Nh%C3%A2n+T%C3%B4ng,+Khu%C3%AA+Trung,+C%E1%BA%A9m+L%E1%BB%87,+%C4%90%C3%A0+N%E1%BA%B5ng+550000,+Vi%E1%BB%87t+Nam/@16.0331143,108.2070759,17z/data=!3m1!4b1!4m6!3m5!1s0x314219924774232b:0x4cb9aeda8460da38!8m2!3d16.0331092!4d108.2096508!16s%2Fg%2F11j8w0flg6" target="_blank"><i class="fa-solid fa-location-dot"></i>ATM TECHCOM<br> 210 Lý Nhân Tông,  P. Khuê Trung, Q. Cẩm Lệ, Tp. Đà Nẵng, Việt Nam</a></li>
                        <li><a href="tel:0988558727"><i class="fa-solid fa-phone"></i>0988558727</a></li>
                        <li><a href="mailto:info@daotaonghedulich.com"><i class="fa-solid fa-envelope"></i>info@daotaonghedulich.com</a></li>
                        <li><a href="{{ route('w.home') }}"><i class="fa-solid fa-clock"></i> 08:30-11:30, 13:30-16:30 (Thứ 2 đến thứ 6)</a></li>
                    </ul>
                </div>
                <div class="col-12 col-lg-6 col-xl-3">
                    <div class="footer-title"> Về ATM </div>
                    <ul class="list">
                        @foreach ($list_term as $item)
                            <li><a href="{{route('w.blog.show.term', $item->slug)}}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 col-lg-6 col-xl-3">
                    <div class="footer-title"> Hợp tác liên kết </div>
                    <ul class="list">
                        <li><a href="{{ route('us.register.create') }}">Đăng ký giảng viên</a></li>
                        <li><a href="{{ route('w.internship.index') }}">Đào tạo doanh nghiệp </a></li>
                    </ul>
                </div>
                <div class="col-12 col-lg-6 col-xl-3">
                    <div class="footer-title"> Fanpage </div>
                    <ul class="list">
                        <li>
                            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FATMASIACO&tabs&width=255&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" style="border:none;overflow:hidden"
                            width="255px" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                        </li>
                    </ul>
                    <div class="connect-me">Kết nối với ATM</div>
                    <div class="connect-me-icon">
                        {{-- <a href=""><i class="fa-brands fa-square-facebook"></i></a> --}}
                        <a href=""><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <p class="text-white text-center m-0">©2022  ATM Academy là nền tảng web ứng dụng cho đào tạo nghề du lịch đầu tiên ở Đông Nam Á</p>
                </div>
            </div>
        </div>
    </div>
</footer>
