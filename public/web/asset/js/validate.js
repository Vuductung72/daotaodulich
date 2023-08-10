function isEmail($email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	return emailReg.test( $email );
}

function isPhone(phone) {
	var filter = /([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/;
	return filter.test(phone);
}

$().ready(function() {
	$('.input-box, .form-control').on('keydown, keyup', function () {
		var fullnameInput = document.getElementById('fullname');
		if(fullnameInput != null){
			var fullname = $("#fullname").val();
			if( fullname != ''){
				$("#fullname").removeClass("error");
				$("#fullname-error small").hide();
			}
			else{
				$("#fullname").addClass("error");
				$("#fullname-error small").show();
				$("#fullname-error small").html("Tên không được để trống");
			}
		}

		var usernameInput = document.getElementById('name');
		if(usernameInput != null){
			var username = $("#name").val();
			if( username != ''){
				$("#name").removeClass("error");
				$("#name-error small").hide();
			}
			else{
				$("#name").addClass("error");
				$("#name-error small").show();
				$("#name-error small").html("Tên không được để trống");
			}
		}
		
		var emailInput = document.getElementById('email');
		if(emailInput != null) {
			let  email = $("#email").val();
			var check_mail = isEmail(email);
			if( email != ''){
				if( check_mail == false) {
					$("#email").addClass("error");
					$("#email-error small").show();
					$("#email-error small").html("Nhập email đúng định dạng");
				}
				if( check_mail == true) {
					$("#email").removeClass("error");
					$("#email-error small").hide();
				}
			}
			if( email == '') {
				$("#email").addClass("error");
				$("#email-error small").show();
				$("#email-error small").html("Email không được để trống");
			}
		}
		

		var phoneInput = document.getElementById('phone');
		if(phoneInput != null){
			let  phone = $("#phone").val();
			var check_phone = isPhone(phone);
			if( phone != ''){
				if( check_phone == false) {
					$("#phone").addClass("error");
					$("#phone-error small").show();
					$("#phone-error small").html("Nhập số điện thoại đúng định dạng");
				}
				if( check_phone == true) {
					$("#phone").removeClass("error");
					$("#phone-error small").hide();
				}
			}
			if( phone == '') {
				$("#phone").addClass("error");
				$("#phone-error small").show();
				$("#phone-error small").html("Số điện thoại không được để trống");
			}
		}
	
		var passwordInput = document.getElementById('password');
		if(passwordInput != null){
			var password = $("#password").val();
			if( $( password) != '' ){
				if( password.length < 6) {
					$("#password").addClass("error");
					$("#password-error small").show();
					$("#password-error small").html("Nhập mật khẩu từ 6 kí tự trở lên");
	
				}
				else{
					$("#password").removeClass("error");
					$("#password-error small").hide();
				}
			}
		}
		
		
		var rePassInput = document.getElementById('re-password');
		if(rePassInput != null) {
			var re_pass = $("#re-password").val();
			if( re_pass != ''){
				if( re_pass.length < 6) {
					$("#re-password").addClass("error");
					$("#re-password-error small").show();
					$("#re-password-error small").html("Nhập mật khẩu từ 6 kí tự trở lên");
				}
				else{
					if(re_pass != password){
						$("#re-password").addClass("error");
						$("#re-password-error small").show();
						$("#re-password-error small").html("Mật khẩu không khớp");
					}
					else{
						$("#re-password").removeClass("error");
						$("#re-password-error small").hide();
					}
				}
			}
		}
		

		var certificateInput = document.getElementById('certificate');
		if(certificateInput != null){
			var certificate = $("#certificate").val();
			if( certificate != ''){
				$("#certificate").removeClass("error");
				$("#certificate-error small").hide();
			}
			else{
				$("#certificate").addClass("error");
				$("#certificate-error small").show();
				$("#certificate-error small").html("Chứng chỉ không được để trống");
			}
		}
		
		var describeInput = document.getElementById('describe');
		if(describeInput != null){
			var describe = $("#describe").val();
			if( describe != ''){
				$("#describe").removeClass("error");
				$("#describe-error small").hide();
			}
			else{
				$("#describe").addClass("error");
				$("#describe-error small").show();
				$("#describe-error small").html("Mô tả không được để trống");
			}
		}
		
		var experienceInput = document.getElementById('experience');
		if(experienceInput != null) {
			var experience = $("#experience").val();
			if( experience != ''){
				$("#experience").removeClass("error");
				$("#experience-error small").hide();
			}
			else{
				$("#experience").addClass("error");
				$("#experience-error small").show();
				$("#experience-error small").html("Kinh nghiệm không được để trống");
			}
		}
		
		var addressInput = document.getElementById('address');
		if(addressInput != null){
			var address = $("#address").val();
			if( address != ''){
				$("#address").removeClass("error");
				$("#address-error small").hide();
			}
			else{
				$("#address").addClass("error");
				$("#address-error small").show();
				$("#address-error small").html("Địa chỉ không được để trống");
			}
		}

		var regularAddressInput = document.getElementById('regular_address');
		if(regularAddressInput != null){
			var regularAddress = $("#regular_address").val();
			if( regularAddress != ''){
				$("#regular_address").removeClass("error");
				$("#regular_address-error small").hide();
			}
			else{
				$("#regular_address").addClass("error");
				$("#regular_address-error small").show();
				$("#regular_address-error small").html("Địa chỉ thường trú không được để trống");
			}
		}

		var currentAddressInput = document.getElementById('current_address');
		if(currentAddressInput != null){
			var currentAddress = $("#current_address").val();
			if( currentAddress != ''){
				$("#current_address").removeClass("error");
				$("#current_address-error small").hide();
			}
			else{
				$("#current_address").addClass("error");
				$("#current_address-error small").show();
				$("#current_address-error small").html("Địa chỉ thường trú không được để trống");
			}
		}


		var birthdayInput = document.getElementById('birthday');
		if(birthdayInput != null){
			var birthday = $("#birthday").val();
			if( birthday != ''){
				$("#birthday").removeClass("error");
				$("#birthday-error small").hide();
			}
			else{
				$("#birthday").addClass("error");
				$("#birthday-error small").show();
				$("#birthday-error small").html("Ngày sinh không được để trống");
			}
		}

		var startTimeInput = document.getElementById('start_time');
		if(startTimeInput != null){
			var startTime = $("#start_time").val();
			if( startTime != ''){
				$("#start_time").removeClass("error");
				$("#start_time-error small").hide();
			}
			else{
				$("#start_time").addClass("error");
				$("#start_time-error small").show();
				$("#start_time-error small").html("Thời gian bắt đầu thực tập không được để trống");
			}
		}

		var timeInput = document.getElementById('time');
		if(timeInput != null){
			var time = $("#time").val();
			if( time != ''){
				$("#time").removeClass("error");
				$("#time-error small").hide();
			}
			else{
				$("#time").addClass("error");
				$("#time-error small").show();
				$("#time-error small").html("Thời gian thực tập không được để trống");
			}
		}

		var wageInput = document.getElementById('wage');
		if(wageInput != null){
			var wage = $("#wage").val();
			if( wage != ''){
				$("#wage").removeClass("error");
				$("#wage-error small").hide();
			}
			else{
				$("#wage").addClass("error");
				$("#wage-error small").show();
				$("#wage-error small").html("Lương không được để trống");
			}
		}

		var quantityInput = document.getElementById('quantity');
		if(quantityInput != null){
			var quantity = $("#quantity").val();
			if( quantity != ''){
				$("#quantity").removeClass("error");
				$("#quantity-error small").hide();
			}
			else{
				$("#quantity").addClass("error");
				$("#quantity-error small").show();
				$("#quantity-error small").html("Số lượng không được để trống");
			}
		}

		var nationalityInput = document.getElementById('nationality');
		if(nationalityInput != null){
			var nationality = $("#nationality").val();
			if( nationality != ''){
				$("#nationality").removeClass("error");
				$("#nationality-error small").hide();
			}
			else{
				$("#nationality").addClass("error");
				$("#nationality-error small").show();
				$("#nationality-error small").html("Quốc tịch không được để trống");
			}
		}

	})

	var professionInput = document.getElementById('profession');
	if(professionInput != null){
			$('#profession')
			.select2()
			.on('change', function(e) {
					var profession = $("#profession").select2("val");
					// console.log(profession);
					if(profession != ''){
						$("#profession").removeClass("error");
						$("#profession-error small").hide();
					}
					else{
						$("#profession").addClass("error");
						$("#profession-error small").show();
						$("#profession-error small").html("Ngành nghề tuyển chọn không được để trống");
					}
			});
	}

	$("#agree-term").change(function() {
		if(this.checked) {
			$("#agree-term").removeClass("error");
			$('#agree-term-error small').hide();
		}
	  else
		{
			$("#agree-term").addClass("error");
			$('#agree-term-error small').show();
			$('#agree-term-error small').html("Vui lòng tích chọn");
		}
	});

	$(".toggle-password").click(function() {

		$(this).toggleClass("fa-eye fa-eye-slash");
		var input = $($(this).attr("toggle"));
		if (input.attr("type") == "password") {
		  input.attr("type", "text");
		} else {
		  input.attr("type", "password");
		}
	});

	/* validate form */

	$("#register-form").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"name": {
				required: true,
				maxlength: 255
			},
			"email": {
				required: true,
				email: true
			},
			"phone": {
				required: true,
				number: true,
				minlength: 7,
				maxlength: 10,
			},
			"password": {
				required: true,
				minlength: 6
			},
			"re-password": {
				required: true,
				equalTo: "#password",
				minlength: 6
			},
			"agree-term": {
				required: true,
				minlength: 1
			}
		},

		messages: {
			"name": {
				required: `<small class="text-danger">Tên không được để trống</small>`,
				maxlength: `<small class="text-danger">Nhập tên tối đa 255 kí tự</small>`,
			},
			"email": {
				required: `<small class="text-danger">Địa chỉ Email không được để trống</small>`,
				email: `<small class="text-danger">Email nhập chưa đúng định đạng</small>`
			},
			"phone": {
				required: `<small class="text-danger">Bắt buộc nhập số điện thoại</small>`,
				number: `<small class="text-danger">Số điện thoại không đúng định dạng</small>`,
				minlength: `<small class="text-danger">Không nhập số điện thoại dưới 7 kí tự</small>`,
				maxlength: `<small class="text-danger">Không nhập số điện thoại trên 10 kí tự</small>`
			},
			"password": {
				required: `<small class="text-danger">Mật khẩu không được để trống</small>`,
				minlength: `<small class="text-danger">Nhập mật khẩu ít nhất 6 kí tự</small>`
			},
			"re-password": {
				required: `<small class="text-danger">Mật khẩu không được để trống</small>`,
				equalTo: `<small class="text-danger">Mật khẩu không khớp</small>`,
				minlength: `<small class="text-danger">Nhập mật khẩu ít nhất 6 kí tự</small>`
			},
			"agree-term": {
				required: `<small class="text-danger">Đồng ý với điều khoản dịch vụ của chúng tôi</small>`
			}
		},

		submitHandler: function(form) {
			console.log("oke");
			form.submit();
		}
	});

	$("#form-pasword-account").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"password": {
				required: true,
				minlength: 6
			},
			"re-password": {
				required: true,
				equalTo: "#password",
				minlength: 6
			}
		},

		messages: {
			"password": {
				required: `<small class="text-danger">Mật khẩu không được để trống</small>`,
				minlength: `<small class="text-danger">Nhập mật khẩu ít nhất 6 kí tự</small>`
			},
			"re-password": {
				required: `<small class="text-danger">Mật khẩu không được để trống</small>`,
				equalTo: `<small class="text-danger">Mật khẩu không khớp</small>`,
				minlength: `<small class="text-danger">Nhập mật khẩu ít nhất 6 kí tự</small>`
			}
		},

		submitHandler: function(form) {
			console.log("oke");
			form.submit();
		}
	});

	$("#login-form").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"email": {
				required: true,
				email: true
			},
			"password": {
				required: true,
				minlength: 6
			},
		},

		messages: {
			"email": {
				required: `<small class="text-danger">Địa chỉ Email không được để trống</small>`,
				email: `<small class="text-danger">Email nhập chưa đúng định đạng</small>`
			},
			"password": {
				required: `<small class="text-danger">Mật khẩu không được để trống</small>`,
				minlength: `<small class="text-danger">Nhập mật khẩu ít nhất 6 kí tự</small>`
			},
		},

		submitHandler: function(form) {
			console.log("oke");
			form.submit();
		}
	});

	$("#customer-login").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"email": {
				required: true,
				email: true
			},
			"password": {
				required: true,
				minlength: 6
			},
		},

		messages: {
			"email": {
				required: `<small class="text-danger">Địa chỉ Email không được để trống</small>`,
				email: `<small class="text-danger">Email nhập chưa đúng định đạng</small>`
			},
			"password": {
				required: `<small class="text-danger">Mật khẩu không được để trống</small>`,
				minlength: `<small class="text-danger">Nhập mật khẩu ít nhất 6 kí tự</small>`
			},
		},

		submitHandler: function(form) {
			console.log("oke");
			form.submit();
		}
	});

	$("#customer-register").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"name": {
				required: true,
				maxlength: 15
			},
			"email": {
				required: true,
				email: true
			},
			"password": {
				required: true,
				minlength: 6
			},
			"re-password": {
				required: true,
				equalTo: "#password",
				minlength: 6
			},
		},

		messages: {
			"name": {
				required: `<small class="text-danger">Tên không được để trống</small>`,
				maxlength: `<small class="text-danger">Nhập tên tối đa 15 kí tự</small>`,
			},
			"email": {
				required: `<small class="text-danger">Địa chỉ Email không được để trống</small>`,
				email: `<small class="text-danger">Email nhập chưa đúng định đạng</small>`
			},
			"password": {
				required: `<small class="text-danger">Mật khẩu không được để trống</small>`,
				minlength: `<small class="text-danger">Nhập mật khẩu ít nhất 6 ký tự</small>`
			},
			"re-password": {
				required: `<small class="text-danger">Mật khẩu không được để trống</small>`,
				equalTo: `<small class="text-danger">Mật khẩu không khớp</small>`,
				minlength: `<small class="text-danger">Nhập mật khẩu ít nhất 6 ký tự</small>`
			},
		},

		submitHandler: function(form) {
			console.log("oke");
			form.submit();
		}
	});

	$("#checkout-form").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"name": {
				required: true,
			},
			"email": {
				required: true,
				email: true
			},
			"phone": {
				required: true,
				number: true,
				minlength: 10,
			},
		},

		messages: {
			"name": {
				required: `<small class="text-danger">Tên không được để trống</small>`,
			},
			"email": {
				required: `<small class="text-danger">Địa chỉ Email không được để trống</small>`,
				email: `<small class="text-danger">Email nhập chưa đúng định đạng</small>`
			},
			"phone": {
				required: `<small class="text-danger">Bắt buộc nhập số điện thoại</small>`,
				number: `<small class="text-danger">Số điện thoại không đúng định dạng</small>`,
				minlength: `<small class="text-danger">Không nhập số điện thoại dưới 10 kí tự</small>`,
				maxlength: `<small class="text-danger">Không nhập số điện thoại trên 10 kí tự</small>`
			},
		},

		submitHandler: function(form) {
			console.log("oke");
			form.submit();
		}
	});

	$("#contact-form").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"name": {
				required: true,
			},
			"email": {
				required: true,
				email: true
			},
			"phone": {
				required: true,
				number: true,
				minlength: 10,
			},
		},

		messages: {
			"name": {
				required: `<small class="text-danger">Tên không được để trống</small>`,
			},
			"email": {
				required: `<small class="text-danger">Địa chỉ Email không được để trống</small>`,
				email: `<small class="text-danger">Email nhập chưa đúng định đạng</small>`
			},
			"phone": {
				required: `<small class="text-danger">Số điện thoại không được để trống</small>`,
				number: `<small class="text-danger">Số điện thoại không đúng định dạng</small>`,
				minlength: `<small class="text-danger">Không nhập số điện thoại dưới 10 kí tự</small>`,
				maxlength: `<small class="text-danger">Không nhập số điện thoại trên 10 kí tự</small>`
			},
		},

		submitHandler: function(form) {
			console.log("oke");
			form.submit();
		}
	});

	$("#expert-form").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"fullname": {
				required: true,
			},
			"birthday": {
				required: true
			},
			"email": {
				required: true,
				email: true
			},
			"password": {
				minlength: 6
			},
			"phone": {
				required: true,
				number: true,
				minlength: 10,
			},
			"nationality": {
				required: true,
			},
			"regular_address": {
				required: true,
			},
			"current_address": {
				required: true,
			},
			
			"agree-term": {
				required: true
			}
			

		},

		messages: {
			"fullname": {
				required: `<small class="text-danger">Họ và tên đệm không được để trống</small>`,
			},
			"birthday": {
				required: `<small class="text-danger">Ngày sinh không được để trống</small>`,
			},
			"email": {
				required: `<small class="text-danger">Địa chỉ Email không được để trống</small>`,
				email: `<small class="text-danger">Email nhập chưa đúng định đạng</small>`
			},
			"password": {
				minlength: `<small class="text-danger">Nhập mật khẩu ít nhất 6 kí tự</small>`
			},
			"phone": {
				required: `<small class="text-danger">Bắt buộc nhập số điện thoại</small>`,
				number: `<small class="text-danger">Số điện thoại không đúng định dạng</small>`,
				minlength: `<small class="text-danger">Không nhập số điện thoại dưới 10 kí tự</small>`,
				maxlength: `<small class="text-danger">Không nhập số điện thoại trên 10 kí tự</small>`
			},
			"nationality": {
				required: `<small class="text-danger">Quốc tịch không được để trống</small>`,
			},
			"regular_address": {
				required: `<small class="text-danger">Địa chỉ thường trú không được để trống</small>`,
			},
			"current_address": {
				required: `<small class="text-danger">Địa chỉ hiện tại không được để trống</small>`,
			},
			"agree-term": {
				required: `<small class="text-danger">Cam kết không để trống</small>`,
			},
			
		},

		submitHandler: function(form) {
			console.log("oke");
			form.submit();
		}
	});

	$.validator.addMethod("requiredProfession", function(value, element, arg){
		return arg != value;
	}, "Value must not equal arg.");

	$("#internship-form").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"fullname": {
				required: true,
			},
			"password": {
				minlength: 6
			},
			"address": {
				required: true
			},
			"describe": {
				required: true
			},

		},

		messages: {
			"fullname": {
				required: `<small class="text-danger">Tên không được để trống</small>`,
			},
			"password": {
				minlength: `<small class="text-danger">Nhập mật khẩu ít nhất 6 kí tự</small>`
			},
			"address": {
				required: `<small class="text-danger">Địa chỉ không được để trống</small>`,
			},
			"describe": {
				required: `<small class="text-danger">Mô tả không được để trống</small>`
			},
		},

		submitHandler: function(form) {
			console.log("oke");
			form.submit();
		}
	});

	$("#recruitment-form").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"start_time": {
				required: true
			},
			"time": {
				required: true
			},
			"profession_id": {
				required: true,
			},
			"wage": {
				required: true
			},
			"quantity": {
				required: true
			},
			"describe": {
				required: true
			},

		},

		messages: {
			"start_time": {
				required: `<small class="text-danger">Thời gian bắt đầu thực tập không được để trống</small>`,
			},
			"time": {
				required: `<small class="text-danger">Thời gian thực tập không được để trống</small>`,
			},
			"profession_id": {
				required: `<small class="text-danger">Ngành nghề tuyển chọn không được để trống</small>`,
			},
			"wage": {
				required: `<small class="text-danger">Lương không được để trống</small>`,
			},
			"quantity": {
				required: `<small class="text-danger">Số lượng thực tập cần tuyển không được để trống</small>`,
			},
			"describe": {
				required: `<small class="text-danger">Mô tả không được để trống</small>`
			},
		},

		submitHandler: function(form) {
			console.log("oke");
			form.submit();
		}
	});

	$("#feedback-course-form").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"content": {
				required: true
			},
			"star": {
				required: true
			},

		},

		messages: {
			"content": {
				required: `<small class="text-danger">Nêu cảm nhận của bạn về khóa học</small>`
			},
			"star": {
				required: `<small class="text-danger">Đánh giá của bạn về khóa học</small>`
			},
		},

		submitHandler: function(form) {
			console.log("oke");
			form.submit();
		}
	});

});




