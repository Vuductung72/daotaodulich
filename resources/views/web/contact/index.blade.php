@extends('web.layouts.master')
@section('page_title', 'Liên hệ')
@section('page_keywords', config('constant.page_keywords_contact'))
@section('page_description', config('constant.page_description_contact'))
@section('page_og:image',asset(config('constant.page_images_contact')))
@section('content')
    <div id="page-contact">
        <!--contact map start-->
        <div class="contact_map mt-45">
        <div class="map-area">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.651896653538!2d108.20738571536948!3d16.031626544701638!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219920d1b2f83%3A0x76b211273c6094f9!2zMjAxIEzDvSBOaMOibiBUw7RuZywgS2h1w6ogVHJ1bmcsIEPhuqltIEzhu4csIMSQw6AgTuG6tW5nIDU1MDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1679382403746!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        </div>
        <!--contact map end-->
        
        <!--contact area start-->
        <div class="contact_area">
            <div class="container">   
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                    <div class="contact_message content">
                            <h3>Liên hệ với chúng tôi</h3>    
                            <p>ATM ACADEMY cung cấp các khóa học và chương trình đào tạo chuyên sâu về ngành du lịch và khách sạn. Bạn có thể liên lạc trực tiếp để biết thêm thông tin về các khóa học và chương trình đào tạo tại ATM ACADEMY.</p>
                            <ul>
                                <li><i class="fa-solid fa-location-dot"></i>ATM TECHCOM. 210 Lý Nhân Tông,  P. Khuê Trung, Q. Cẩm Lệ, Tp. Đà Nẵng, Việt Nam</li>
                                <li><i class="fa fa-phone"></i> <a href="tel:0988558727">0988558727</a></li>
                                <li><i class="fa-solid fa-envelope"></i> <a href="mailto:info@daotaonghedulich.com">info@daotaonghedulich.com</a></li>
                            </ul>             
                        </div> 
                    </div>
                    <div class="col-lg-6 col-md-12">
                    <div class="contact_message form">
                            <h3>Thông tin của bạn</h3>   
                            <form action="{{route('w.contact.store')}}" method="POST" id="contact-form">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên:</label>
                                    <input type="name" name="name" class="form-control" placeholder="Nhập tên ..." id="name">
                                </div>
                                <div class="form-group">
                                <label for="email">Địa chỉ email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Địa chỉ email ..." id="email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại:</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Số điện thoại ..." id="phone">
                                </div>
                                <div class="form-group">
                                <label for="note">Ghi chú:</label>
                                <textarea class="form-control" id="note" name="note" rows="3" placeholder="Ghi chú ..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Gửi</button>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>    
        </div> 
    </div>
    <!--contact area end-->
@endsection