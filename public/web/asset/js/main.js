//chặn f12
document.onkeydown = function(e) {
    if (e.keyCode == 123) { // 123 là mã phím cho F12
      return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 73) { // Ctrl + Shift + I cũng là phím tắt để mở DevTools trên một số trình duyệt
      return false;
    }
};

/* chặn copy ảnh */
$(document).ready(function() {
    $('img').on('contextmenu', function() {
      return false;
    });
  });

/* js tung */
/* xử lí form nạp tiền */

var format = function(num){
    var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
      parts = str.split(".");
      str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
      if(str[j] != ",") {
        output.push(str[j]);
        if(i%3 == 0 && j < (len - 1)) {
          output.push(",");
        }
        i++;
      }
    }
    formatted = output.reverse().join("");
    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};

$(document).ready(function () {
/* HÀM CHỈ CHO NHẬP SỐ */
    $("#section-bank .input-money, #phone, #quantity, #wage").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });

    $(".input-money").keyup(function () {
        var money = $(this).val();
        $('.input-convert-amount span').html(format(money));
        if(money == ''){
            $('.input-convert-amount span').html('0');
        }
    });

    $("#section-bank #banking .input-money-banking").keyup(function () {
        var money = $(this).val();
        $('#banking .input-convert-amount span').html(format(money));
        if(money == ''){
            $('#banking .input-convert-amount span').html('0');
        }
        if(money < 20000){
            $("#banking #alert-error-money").removeClass('d-none');
            $("#banking .btn-payment").prop('disabled', true);
        }
        else {
            $("#alert-error-money").addClass('d-none');
            $(".btn-payment").prop('disabled', false);
        }
    });

/* an hien so tien tai khoan */
      $("#toggle-button-money").click(function() {
		$('#toggle-button-money i').toggleClass("fa-eye fa-eye-slash");
		var input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
		  input.attr("type", "text");
		} else {
		  input.attr("type", "password");
		}
	});

    $("#section-bank #momo .input-money-banking").keyup(function () {
        var money = $(this).val();
        $('#momo .input-convert-amount span').html(format(money));
        if(money == ''){
            $('#momo .input-convert-amount span').html('0');
        }
        if(money < 20000){
            $("#momo #alert-error-money").removeClass('d-none');
            $("#momo .btn-payment").prop('disabled', true);
        }
        else {
            $("#momo #alert-error-money").addClass('d-none');
            $("#momo .btn-payment").prop('disabled', false);
        }
    });
})




//  Format Number
// function addCommas(str) {
//     var amount = new String(str);
//     amount = amount.split("").reverse();

//     var output = "";
//     for (var i = 0; i <= amount.length - 1; i++) {
//         output = amount[i] + output;
//         if ((i + 1) % 3 == 0 && (amount.length - 1) !== i)
//             output = '.' + output;
//     }
//     return output;
// }

/* nav */
$(document).ready(function(){
    // $(window).on( 'load', function(){
    //     $('#preloader').delay(100).fadeOut('slow',function(){
    //         $(this).remove();
    //     });
    // });

    $(".navbar-toggler").click(function(){
        $("#navbarMobile").slideToggle();
        /* $(".search__mobille").slideToggle();  */
        $(".navbarMobile--overlay").fadeToggle();
        $(".bars").toggle();
        $(".xmark").toggle();
    });
    $(".navbarMobile--overlay").click(function(){
        $("#navbarMobile").slideToggle("slow");
        /* $(".search__mobille").slideToggle();  */
        $(".navbarMobile--overlay").fadeToggle();
        $(".bars").toggle();
        $(".xmark").toggle();
    });

    $('.navbar-toggle-account').click(function (e) {
        $('.side-bar-bank ul').slideToggle();

    });

    // button-contact
    $('#contact-button').on('click', function(){
        $(this).find('i').toggleClass('fa-times');
        $(this).toggleClass('open');
    });

    $(window).scroll(function(){
        if($(window).width() > 992){
            if($(this).scrollTop() > 100){
                $('.header__bottom').addClass('sticky');
            } else{
                $('.header__bottom').removeClass('sticky');
            }
        }
    });

    /* load file image */
    function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            $('#avatarImage').attr('src', e.target.result);
            $('#avatarImage').hide();
            $('#avatarImage').fadeIn(650);
          }
          reader.readAsDataURL(input.files[0]);
        }
    }

    $("#avatar").change(function() {
        readURL(this);
    });

    /* scroll to top */
    // Scroll Top Hide Show
    $(window).on('scroll', function(){
        if ($(this).scrollTop() > 250) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    //Scroll To Top Animate
    $('.scroll-to-top').on('click', function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

    $(window).resize(function() {
        if ($(window).width() > 992) {
            $('#navbarMobile').hide();
            /* $('.search__mobille').hide();  */
            $('.navbarMobile--overlay').hide();
            $('#navbarMobile').removeClass(".collapse show");
            $('.side-bar-bank ul').removeClass(".collapse show");
            $('.side-bar-bank ul').removeAttr( 'style' );

        }
        else{
            /* $('.search__mobille').show();  */
            $('.bars').show();
            $('.xmark').hide();
        }
    });

    $('.carousel').carousel({
    interval: 2000
    });

      //calculate price checkout
      $("#total_price").each(function () {
        var itemPrice = $("#item_price_hiden").val();
        var sale = $("#sale").val();

        var total = itemPrice - (itemPrice * sale)/100;

        $("#item_price").val(addCommas(itemPrice));

        console.log(addCommas(total * 1));

        $("#total_price").val(addCommas(total * 1));

      });

       /* exam */
       /* xử lí click câu số bn */
      $(".number-question span").on("click", function() {
        $(".number-question").removeClass("active");
        $(this).parent().addClass("active");
        $(".scroll-on").scrollCenter(".active", 200);

          $(".answers").addClass("d-none");
        // Display active tab
        let currentTab = $(this).attr('data-id');
        $(currentTab).removeClass("d-none");


        return false;
      });

      /* xử lí tab nạp tiền */
      $(".payment-widget").on("click", function() {
        $(".payment-widget").removeClass("payment-widget-active");
        $(this).addClass("payment-widget-active");

        $(".payment-list").addClass("d-none");
        let tabPayment = $(this).attr('data-target');
        $(tabPayment).removeClass("d-none");
      });

      $(".payment-method").on("click", function() {
        $(".payment-method").removeClass("payment-method-active");
        $(this).addClass("payment-method-active");
        $(".input-amout").removeClass("d-none");
      })




        jQuery.fn.scrollCenter = function(elem, speed) {

            var active = jQuery(this).find(elem); // find the active element
            var activeWidth = active.width()/2; // get active width center

            var pos = active.position().left+activeWidth; //get left position of active li + center position
            var currentscroll = jQuery(this).scrollLeft(); // get current scroll position
            var divwidth = jQuery(this).width(); //get div width
            pos = pos + currentscroll - divwidth / 2;
            jQuery(this).animate({
            scrollLeft: pos
            }, speed == undefined ? 1000 : speed);
            return this;
        };

        jQuery.fn.scrollleft = function(elem, speed) {
            jQuery(this).animate({
                scrollLeft: jQuery(this).scrollLeft() - jQuery(this).offset().left + jQuery(elem).offset().left
            }, speed == undefined ? 1000 : speed);
            return this;
        };

        function startTimer() {
            var timeExist = document.getElementById('timer');
            if(timeExist != null){
                var presentTime = document.getElementById('timer').innerHTML;
            var timeArray = presentTime.split(/[:]+/);
            var m = timeArray[0];
            var s = checkSecond((timeArray[1] - 1));
            if(s==59){m=m-1}{
                if(m==-1){
                    Swal.fire({
                        title: 'Thông báo',
                        text: "Hết thời gian. Bài thi của bạn đã kết thúc!",
                        icon: 'info',
                        showCancelButton: true,
                        showConfirmButton: false,
                        cancelButtonColor: '#3085d6',
                        cancelButtonText: 'Xem kết quả',
                    }).then((result) => {
                        if (!result.isConfirmed) {
                            $('#formExam').submit();
                        }
                    })
                }
            }
            if((m + '').length == 1){
                m = '0' + m;
            }
            if(m < 0){
                m.stop();
            }
            document.getElementById('timer').innerHTML = m + ":" + s;
            setTimeout(startTimer, 1000);
            }

        }

        function checkSecond(sec) {
        if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
        if (sec < 0) {
            sec = "59"
        };
        return sec;
        }

        startTimer();


        $("#previous-question").click(function (e) {
            e.preventDefault();
            $('.nav-tabs > .active').prev('li').find('.question').triggerHandler('click');

        });

        $("#next-question").click(function (e) {
            e.preventDefault();
            $('.nav-tabs > .active').next('li').find('.question').triggerHandler('click');

        });

        $('#page-course-details .lesson-part').click(function (e) {
            $(this).next().stop().slideToggle("slow");
            $(this).parent().toggleClass("open");
        });
});

/* js thuat */
//   reponsive sidebar shop
$(document).ready(function()
  {
      var isMenuOpen = false;

      $('.btn_menu-shop').click(function()
      {
          if (isMenuOpen == false)
          {
            $("#menu_shop").clearQueue().animate({
                left : '0px'
            })
        $("#grey_back").fadeIn('fast');
            $(this).fadeOut(200);
            $(".close").fadeIn(300);

            isMenuOpen = true;
          }
      });
      $('#grey_back').click(function()
      {
          if (isMenuOpen == true)
          {
              $("#menu_shop, #menu_expert").clearQueue().animate({
                  left : '-570px'
              })
              $("#page").clearQueue().animate({
                  "margin-left" : '0px'
              })
        $("#grey_back").fadeOut('fast');
              $(this).fadeOut(200);
              $(".btn_menu-shop, .btn_menu-expert").fadeIn(300);

              isMenuOpen = false;
          }
      });

      $('.btn_menu-expert').click(function()
      {
          if (isMenuOpen == false)
          {
            $("#menu_expert").clearQueue().animate({
                left : '0px'
            })
        $("#grey_back").fadeIn('fast');
            $(this).fadeOut(200);
            $(".close").fadeIn(300);

            isMenuOpen = true;
          }
      });

    $('.btn-menu-learning').click(function()
    {
        if (isMenuOpen == false)
        {
        $("#list-lesson").clearQueue().animate({
            left : '0px'
        })
        $("#overlay-learning").fadeIn('fast');
            $(this).fadeOut(200);
            $(".close").fadeIn(300);

            isMenuOpen = true;
        }
    });
    $('#overlay-learning').click(function()
    {
        if (isMenuOpen == true)
        {
            $("#list-lesson").clearQueue().animate({
                left : '-570px'
            })
            $("#page").clearQueue().animate({
                "margin-left" : '0px'
            })
    $("#overlay-learning").fadeOut('fast');
            $(this).fadeOut(200);
            $(".btn-menu-learning").fadeIn(300);

            isMenuOpen = false;
        }
    });
  });
$(document).ready(function () {
    // slider logo (owl-carousel2)
    $(".slider-logo-partners").owlCarousel({
        items: 6,
        loop: true,
        margin: 50,
        dots: false,
        autoplay: true,
        autoplayTimeout: 1500,
        autoplayHoverPause: true,
        autoplaySpeed: 1000,
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 3,
            },
            600: {
                items: 4,
            },
            1200: {
                items: 6,
            },
        },
    });

    $('.slider-feedback').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        items: 1,
        dots: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        autoplay:true,
        autoplayTimeout:5000,
        autoplaySpeed: 2000,
        autoplayHoverPause:true,
        lazyLoad: true
    })
});

// bai viet lien quan
$('.slider-course-related').owlCarousel({
    loop:true,
    margin:20,
    dots: false,
    autoplay:true,
    lazyLoad: true,
    autoplayTimeout:2500,
    autoplayHoverPause:true,
    autoplaySpeed: 1000,
    nav: true,
    navText: ['<img alt="pre" src="../../../../web/asset/images/icon-nextleft.png">','<img alt="next" src="../../../../web/asset/images/icon-nextleft.png">'],
    responsive:{
      0:{
          items:1,
          margin:10,
          nav: false,
      },
      400:{
        items:1,
        margin:10,
        nav: false,
    },
      700:{
          items:3,
          margin:10,
          nav: false,
      },
      1000:{
          items:4,
      }
  }
});

//   chọn nghề
$(document).ready(function() {
    $('#profession').select2({
        placeholder: 'Chọn nghề cần tuyển',
        allowClear: true
    });
});

$(document).ready(function() {
    $('.expert-input').click(function(e) {
        Swal.fire({
            title: 'Thông báo',
            text: "Bạn đã chắc chắn lựa chọn chuyên gia này chưa?",
            icon: 'question',
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy bỏ!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Thành công',
                'Chọn chuyên gia đồng hành thành công!',
                'success'
              )
              $('#select-expert-form').trigger('submit');
            }
            else{
                $(".expert-input").prop("checked", false);
            }
          });
    });
});

