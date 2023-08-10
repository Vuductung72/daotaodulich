

// tab content
$(document).ready(function () {
    // Hàm active tab nào đó
    function activeTab(obj) {
        // Xóa class active tất cả các tab
        $('.home-quick-nav li').removeClass('active');

        // Thêm class active vòa tab đang click
        $(obj).addClass('active');

        // Lấy href của tab để show content tương ứng
        var id = $(obj).find('a').attr('href');

        // Ẩn hết nội dung các tab đang hiển thị
        $('.home-list').hide();

        // Hiển thị nội dung của tab hiện tại
        $(id).show();
    }

    // Sự kiện click đổi tab
    $('.home-quick-nav li').click(function () {
        activeTab(this);
        return false;
    });

    // Active tab đầu tiên khi trang web được chạy
    activeTab($('.home-quick-nav li:first-child'));
});

// end tab content


// end menu liên kết wallet

    $(document).ready(function () {
        $('.autoplay').slick({
            arrows:true,
            Swipe: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            nextArrow: '.slickNext',
            prevArrow: '.slickPrev'
        });
    });


$(document).ready(function () {
    $('.handle').click(function() {
        if ($("#show").css("left") == ("-73px")) {
            $('#show').css("left", "0px");
        } else {
            $('#show').css("left", "-73px");
        }

    });

});
