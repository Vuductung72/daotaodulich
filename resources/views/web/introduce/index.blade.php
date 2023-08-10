@extends('web.layouts.master')
@section('page_title', 'Giới thiệu')
@section('page_keywords', config('constant.page_keywords_introduce'))
@section('page_description', config('constant.page_description_introduce'))
@section('page_og:image',asset(config('constant.page_images_introduce')))
@section('content')
    <div id="page-introduce">
        <!--breadcrumbs area end-->
        <div class="introduce-wrap">
            <div class="introduce-bg"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-md-12">   
                        <h2 class="introduce-title text-center">GIỚI THIỆU CHUNG</h2>							
                    </div>
                </div>
            </div>
            
        </div>

        <!--== Start Blog Detail Area Wrapper ==-->
        <div class="blog-detail-area section-space">
            <div class="container">
                <div class="row mb-n6 post-border-items">
                    <p><b>ATM Academy</b> là nền tảng web ứng dụng cho đào tạo nghề du lịch đầu tiên ở Đông Nam Á được <b>Công ty Phát triển Công nghệ ATM</b>, <b>Công ty Tư vấn và Quản lý ATM đầu tư phát triển và xây dựng bởi NET5S</b>. 
                    <br>
                    <img src="{{ asset('images/logo-atm.jpg') }}" alt="" style="width: 50%; display: block; margin: 0 auto">
                    <br>
                    Với phương châm "Học để làm, học để thành công", <b>ATM Academy</b> tập trung vào việc áp dụng kiến thức vào thực tế. Học viên sẽ được thực hành thực tế trong môi trường giả định để cải thiện kỹ năng và trang bị kinh nghiệm cho công việc tương lai.
                    <br>
                    Đặc biệt, <b>ATM Academy</b> có mối quan hệ đối tác với nhiều doanh nghiệp, khách sạn và công ty du lịch lớn trong và ngoài nước. Điều này giúp học viên của công ty dễ dàng tìm được việc làm sau khi tốt nghiệp và có cơ hội phát triển sự nghiệp trong ngành du lịch.
                    <br>
                    <b>ATM Academy</b> đào tạo nghề đối với nghiệp vụ nghề Lễ tân khách sạn, nghiệp vụ nghề Buồng phòng khách sạn và nghiệp vụ nghề Nhà hàng đã được chuyển đổi số và đem đến những lợi ích thiết thực sau:</p>
                    <ol style="padding-left: 8px">
                        <li style="list-style: auto">
                            <span><b>Đối với người học:</b></span>
                            <br>
                            <img src="{{ asset('web/asset/images/letan.webp') }}" alt="" style="width: 50%; display: block; margin: 8px auto">
                            <ul style="padding-left: 16px">
                                <li>Học linh hoạt mọi lúc mọi nơi.</li>
                                <li>Tiết kiệm được thời gian học.</li>
                                <li>Tiết kiệm được thời gian học.</li>
                                <li>Tiết kiệm được ¾ chi phí;.</li>
                                <li>Học chủ động.</li>
                                <li>Quá trình học tự động hóa.</li>
                                <li>Được thực tập tại khách sạn, resort đạt chuẩn quốc tế trong hệ thống đối tác .</li>
                                <li>Tư vấn nghề nghiệp và hỗ trợ học tập bởi các chuyên gia hàng đầu của Việt Nam.</li>
                                <li>Được giới thiệu và kết nối Miễn phí với nhà tuyển dụng </li>
                            </ul>
                        </li>
                        <li style="list-style: auto">
                            <span><b>Đối với nhà tuyển dụng:</b></span>
                            <br>
                            <img src="{{ asset('web/asset/images/gioithieutuyendung.webp') }}" alt="" style="width: 50%; display: block; margin: 8px auto">
                            <ul style="padding-left: 16px">
                                <li>Tìm kiếm ứng viên tuyển dụng đạt yêu cầu nhanh chóng.</li>
                                <li>Tiết kiệm thời gian và chi phí tuyển dụng.</li>
                                <li>Quảng báo thương hiệu Miễn phí tới hàng triệu khách hàng tiềm năng.</li>
                                <li>Được sử dụng Miễn phí tài khoản cho nhân viên học tập/ôn tập kiến thức nghiệp vụ nghề.</li>
                            </ul>
                        </li>
                        <li style="list-style: auto">
                            <span><b>Đối với đối tác đào tạo nghề du lịch:</b></span>
                            <ul style="padding-left: 16px">
                                <li>Sử dụng Miễn phí tài khoản để quảng bá tuyển sinh trên phạm vi rộng tiếp cận hàng triệu học viên tiềm năng.</li>
                                <li>Sử dụng Miễn phí tài khoản tự động hóa để hỗ trợ hoạt động đào tạo của đối tác một cách linh hoạt.</li>
                                <li>Tiết kiệm thời gian và chi phí tổ chức các khóa học.</li>
                                <li>Tăng cường nhận diện thương hiệu của nhà trường.</li>
                        </li>
                    </ol>
                    <p>
                        Với tầm nhìn trở thành trung tâm đào tạo ngành nghề du lịch hàng đầu tại Việt Nam, <b>ATM Academy</b> đang không ngừng nỗ lực để đưa ra những khóa học chất lượng cao, giúp học viên thành công trong ngành du lịch.
                    </p>
                    <p>
                        <span><b>Địa chỉ:</b></span> ATM TECHCOM. 201 Lý Nhân Tông, P. Khuê Trung, Q. Cẩm Lệ, Tp. Đà Nẵng, Việt Nam 
                        <br>
                        <span><b>Email:</b></span> info@daotaonghedulich.com 
                        <br>
                        <span><b>Hotline/Zalo:</b></span> 0988558727 
                        <br>
                        <span><b>Facebook Fanpage:</b></span> <a href="https://facebook.com/ATMASIACO" target="_blank">https://facebook.com/ATMASIACO </a> 
                        <br> 
                        <span><b>Website:</b></span> <a href="{{ route('w.home') }}">www.daotaonghedulich.com</a>
                    </p>
                </div>
            </div>
        </div>
        <!--== End Blog Detail Area Wrapper ==-->
    </div>
@endsection


