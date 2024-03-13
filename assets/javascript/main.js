$(document).ready(function($){
	$("#success").hide();	
	// $("#login-error").hide();
	

	$("#user-error").hide();
	let username_error=true;
	$("#username").keyup(function(){
		validatefirstname();
	});
	function validateusername(){
		let user_value=$("#username").val()
		if (user_value.length=="") {
			$("#user-error").show();
			username_error=false;
			return false;
		}else if(user_value.length <3 || user_value.length >10){
			$("#user-error").show();
			$("#user-error").html("Length of the username must be between 4 to 10 letters long");
			username_error=false;
			return false;
		}else{
			$("#user-error").hide();
		}
	}
	//Validate lname
	$("#lname-error").hide();
	let lastname_error=true;
	$("#lastname").keyup(function(){
		validatelastname();
	});
	function validatelastname(){
		let lname_value=$("#lastname").val();
		if (lname_value.length=="") {
			$("#lname-error").show();
			lastname_error=false;
			return false;
		}else if (lname_value.length<3 || lname_value.length>10) {
			$("#lname-error").show();
			$("#lname-error").html("Last name is either too short or too long");
			lastname_error=false;
			return false;
		}else{
			$("#lname-error").hide();
		}
	}
	// validate email
	$("#email-error").hide();
	let email_error=true;
	$("#email").keyup(function(){
		validateemail();
	});
	function validateemail(){
		let email_value=$("#email").val();
		if (email_value.length=="") {
			$("#email-error").show();
			email_error=false;
			return false;
		}
		if (email_value.length<4) {
			$("#email-error").show();
			$("#email-error").html("Email is too short. Please insert a valid email");
			email_error=false;
			return false;
		}
		// else if (email_value.contains('@')) {
		// 	$("#email_error").show();
		// 	$("#email_error").html("Please insert a valid email");
		// 	email_error=false;
		// 	return false;
		// }
		else{
			$("#email-error").hide();
		}
	}
	// validate idno
	$("#idno-error").hide();
	let idno_error=true;
	$("#idno").keyup(function(){
		validateidno();
	});
	function validateidno(){
		let idnovalue=$("#idno").val();
		if (idnovalue.length<8 || idnovalue.length>12) {
			$("#idno-error").show();
			$("#idno-error").html("Number either too long or too short");
			idno_error=false;
			return false;
		}else{
			$("#idno-error").hide();
		}
	}
	// validate phone number
	$("#phone-error").hide();
	let phonenumber_error=true;
	$("#phone").keyup(function(){
		validatephonenumber();
	});
	function validatephonenumber(){
		let number_value=$("#phone").val();
		if (number_value.length=="") {
			$("#phone-error").show();
			phonenumber_error=false;
			return false;
		}
		else if(number_value.length <10 || number_value.length >13) {
			$("#phone-error").show();
			$("#phone-error").html("Phone number is either too short or too long");
			phonenumber_error=false;
			return false;
		}
		else{
			$("#phone-error").hide();
		}
	}
	// validate image upload
	$("#upload-error").hide();

	// validate gender
	$("#gender-error").hide();
	let gender_error=true;
	$("#gender").keyup(function(){
		validategender();
	});
	function validategender(){
		let gendervalue=$("#gender").val();
	}

	// validate password
	$("#pass-error").hide();
	let password_error=true;
	$("#password").keyup(function(){
		validatepassword();
	});
	function validatepassword(){
		let passwordvalue=$("#password").val();
		if (passwordvalue.length=="") {
			$("#pass-error").show();
			password_error=false;
			return false;
		}
		if (passwordvalue.length<4) {
			$("#pass-error").show();
			$("#pass-error").html("Password is to short");
			password_error=false;
			return false;
		}else{
			$("#pass-error").hide();
		}
	}
	// validate confirm password
	$("#cpass-error").hide();
	let cpassword_error=true;
	$("#cpassword").keyup(function(){
		validateconfirmpassword();
	});
	function validateconfirmpassword(){
		let confirm_password=$("#cpassword").val();
		let passwordvalue=$("#password").val();
		if (confirm_password != passwordvalue) {
			$("#cpass-error").show();
			$("#cpass-error").html("Password do not match");
			cpassword_error=false;
			return false;
		}else{
			$("#cpass-error").hide();
		}

	}
	

	// $("#login-form").submit(function(et){
	// 	et.preventDefault();
	// 	$.ajax({
	// 		type: 'post',
	// 		url: 'http://localhost/Online%20Voting%20System/Voters/functions.php',
	// 		data: $(this).serialize(),
	// 		// data: data,
	// 		success: function(response){
	// 			setTimeout(function() {
	// 				// $("#success").fadeIn();
	// 				if (response=="Login successful") {
	// 					alert(response);
	// 				}				

	// 			}, 
	// 			600);
	// 		},
	// 		error: function(response){
	// 			// $("#login-error").fadeIn();
	// 			alert(response);
	// 		}
	// 	});
	// });

});			





