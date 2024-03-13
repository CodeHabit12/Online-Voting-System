<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		body{
			font-size: 16px;
			background: linear-gradient(115deg,#56d8e4 10%,#9f01ea 90%);
		}
		.container{
			width: 60%;
			margin: 25px auto;
		}
		.title{
			margin-bottom: 1rem;
		}
		form{
			padding: 20px;
			background: #2c3e50;
			color: #fff;
			break-after: 5px;
			break-after: 5px;
		}
		form input,
		form label,
		form button,
		span,
		select,
		a{
			border: 0;
			margin-bottom: 3px;
			display: block;
			width: 90%;
		}
		a{
			text-decoration: none;
			text-align: center;
		}
		form input,
		select,
		a{
			height: 25px;
			line-height: 30px;
			background: fff;
			color: #000;
			padding: 0 6px;
			box-sizing: border-box;
			border-radius: 5px;
		}
		form .btn{
			height: 30px;
			line-height: 30px;
			background: #e67e22;
			color: #fff;
			text-transform: uppercase;
			font-weight: bold;
			margin-top: 1.5rem;
			cursor: pointer;
		}
		form .error{
			color: #ff0000;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1 class="title">Registration</h1>
		<form action="include/function.php" method="post" id="registration" enctype="multipart/form-data">
			<div><span id="error"></span> </div>

			<label for="idno">Identity Number</label>
			<input type="number" name="idno" id="idno" placeholder="12345678" required>
			<span class="error" id="idno-error">Your identity number is required</span>

			<label for="emaill">Email Name (Optional)</label>
			<input type="email" name="email" id="email" placeholder="abc@gmail.com">
			<!-- <span class="error" id="email-error">Your email is required</span> -->

			<label for="phoneNo">Phone Number</label>
			<input type="number" name="phone" id="phone" placeholder="+254" required>
			<span class="error" id="phone-error">Your phone number is required</span>

			<label for="upload-img">Upload profile picture</label>
			<input type="file" name="p_image" id="profile" accept="image/png, image/jpg, image/jpeg">
			<span class="error"></span>

			<label for="upload-img">Upload Id (Front-End)</label>
			<input type="file" name="front_image" id="front" accept="image/png, image/jpg, image/jpeg">
			<span class="error"></span>

			<label for="upload-img">Upload Id (Back-End)</label>
			<input type="file" name="back_image" id="back" accept="image/png, image/jpg, image/jpeg">
			<span class="error"></span>

			<label for="password-insert">Password</label>
			<input type="password" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
			<span class="error" id="pass-error">Your password is required</span>

			<label for="password-confirm">Confirm Password</label>
			<input type="password" name="cpassword" id="cpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
			<span class="error" id="cpass-error">Please confirm your password</span>
			
			<input class="btn" type="submit" id="submitbtn" name="register-btn" value="Register">
			<a href="login.php" class="btn">Back to Login</a>
			<!-- <p class="success" id="success">Registered successfully</p> -->
		</form>
	</div>
	<!-- <script defer src="../assets/javascript/main.js"></script> -->
	<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#idno-error').hide();
			$('#idno').keyup(function(){
				validateId();
			});

			function validateId(){
				let idnoVal=$('#idno').val();
				if (idnoVal.length=="") {
					$('#idno-error').show();
					return false;
				}else if (idnoVal.length<8 || idnoVal.length>9) {
					$('#idno-error').show();
					$('#idno-error').html('Length too short or too long');
					return false;
				}else{
					$('#idno-error').hide();
				}
			}
			$('#user-error').hide();
			$('#username').keyup(function(){
				validateusername();
			});
			function validateusername(){
				let usernameVal=$('#username').val();
				if (usernameVal.length=='') {
					$('#user-error').show();
					return false;
				}else if (usernameVal.length<4) {
					$('#user-error').show();
					$('#user-error').html('Username cant be less than 4 characters long');
					return false;
				}else{
					$('#user-error').hide();
				}
			}

			$('#phone-error').hide();
			$('#phone').keyup(function(){
				validatephone();
			});
			function validatephone(){
				let phoneVal=$('#phone').val();
				if (phoneVal.length=='') {
					$('#phone-error').show();
					return false;
				}else if (phoneVal.length<10 || phoneVal.length>12) {
					$('#phone-error').show();
					$('#phone-error').html('Phone number either too long or too short');
					return false;
				}else{
					$('#phone-error').hide();
				}
			}

			$('#pass-error').hide();
			$('#password').keyup(function(){
				validatepassword();
			});
			function validatepassword(){
				let phoneVal=$('#password').val();
				if (phoneVal.length=='') {
					$('#pass-error').show();
					return false;
				}else if (phoneVal.length<4) {
					$('#pass-error').show();
					$('#pass-error').html('Password too short');
					return false;
				}else{
					$('#pass-error').hide();
				}
			}

			$('#cpass-error').hide();
			$('#cpassword').keyup(function(){
				validatecpassword();
			});
			function validatecpassword(){
				let passwordVal=$('#password').val();
				let cpasswordVal=$('#cpassword').val();
				if (cpasswordVal.length=='') {
					$('#cpass-error').show();
					return false;
				}else if (cpasswordVal.length<4) {
					$('#cpass-error').show();
					$('#cpass-error').html('Password too short');
					return false;
				}else if(passwordVal!=cpasswordVal){
					$('#cpass-error').show();
					$('#cpass-error').html('Passwords do not match');
					return false;
				}else{
					$('#cpass-error').hide();
				}
			}

		});
	</script>


</body>
</html>