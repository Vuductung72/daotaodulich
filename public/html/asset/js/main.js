/* js tung */
/* xử lí form nạp tiền */ 
var money = 0; 
/* HÀM CHỈ CHO NHẬP SỐ */ 
$("#depositamt").keypress(function(event) { 
    return /\d/.test(String.fromCharCode(event.keyCode)); 
  }); 
 
$('.quick-input-button').click( function() { 
    money = $(this).val(); 
    $('.quick-input-button').removeClass('active'); 
    $(this).addClass('active'); 
    $('#depositamt').val(money); 
    /* hàm thay thế giá trị */ 
    $(".input-field-value-hiden").val(money); 
    $('.input-convert-amount span').html(addCommas(money * 1)); 
    $('.input-actual-amount span').html(addCommas(money * 1)); 
 
    if(money < 10000){ 
        $(".alert-error-money span").html("Số tiền nhạp tối thiểu là 10.000 VND"); 
        $("#submit-form-deposit").prop('disabled', true); 
    } 
    else { 
        $(".alert-error-money span").html(''); 
        $("#submit-form-deposit").prop('disabled', false); 
    } 
}) 
 
$("#depositamt").keyup(function () {  
    var money = $(this).val(); 
    $(".input-field-value-hiden").val(money); 
    $('.input-convert-amount span').html(addCommas(money * 1)); 
    $('.input-actual-amount span').html(addCommas(money * 1)); 
    if(money < 10000){ 
        $(".alert-error-money span").html("Số tiền nhạp tối thiểu là 10.000 VND"); 
        $("#submit-form-deposit").prop('disabled', true); 
    } 
    else { 
        $(".alert-error-money span").html(''); 
        $("#submit-form-deposit").prop('disabled', false); 
    } 
     
}); 
 
// Format Number 
function addCommas(str) { 
    var amount = new String(str); 
    amount = amount.split("").reverse(); 
 
    var output = ""; 
    for (var i = 0; i <= amount.length - 1; i++) { 
        output = amount[i] + output; 
        if ((i + 1) % 3 == 0 && (amount.length - 1) !== i) 
            output = '.' + output; 
    } 
    return output; 
} 
 
 
/* nav */ 
$(document).ready(function(){ 
    $(".navbar-toggler").click(function(){ 
        $("#navbarMobile").slideToggle(); 
        $(".search__mobille").slideToggle(); 
        $(".navbarMobile--overlay").fadeToggle(); 
        $(".bars").toggle(); 
        $(".xmark").toggle(); 
    }); 
    $(".navbarMobile--overlay").click(function(){ 
        $("#navbarMobile").slideToggle(); 
        $(".search__mobille").slideToggle(); 
        $(".navbarMobile--overlay").fadeToggle(); 
        $(".bars").toggle(); 
        $(".xmark").toggle(); 
    }); 
 
    $(window).scroll(function(){ 
        if($(this).scrollTop() > 100){ 
            $('.header__bottom').addClass('sticky'); 
        } else{ 
            $('.header__bottom').removeClass('sticky'); 
        } 
    }); 
 
    $(window).resize(function() { 
        if ($(window).width() > 992) { 
            $('#navbarMobile').hide(); 
            $('.search__mobille').hide(); 
            $('.navbarMobile--overlay').hide(); 
            $('#navbarMobile').removeClass(".collapse show");
        } 
        else{
            $('.search__mobille').show(); 
            $('.bars').show(); 
            $('.xmark').hide(); 
        } 
     }); 
    
     $('.carousel').carousel({ 
        interval: 2000 
      });
  }); 


  
/* js thuat */
$(document).ready(function () {
   
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
});

    