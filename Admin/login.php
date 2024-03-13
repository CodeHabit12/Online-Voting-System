<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin | Login Page</title>
	<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		body{
			background-image: url("../assets/images/download (1).jpg");
			background-size: cover;
		}
		.container{
			width: 500px;
			margin: 25px auto;
		}
		.title{
			margin-bottom: 1rem;
		}
		.header {
		    background-color: #333;
		    color: white;
		    padding: 20px;
		    font-size: 24px;
		    text-align: center;
		    display: flex;
		    justify-content: space-between;
		    align-items: center;
		  }
		form{
			padding: 20px;
			background: #2c3e50;
			color: #fff;
			break-after: 5px;
		}
		form input,
		form label,
		a{
			border: 0;
			margin-bottom: 10px;
			display: block;
			width: 100%;
		}
		form input,
		a{
			height: 30px;
			margin-top: 10px;
			line-height: 30px;
			background: fff;
			color: #000;
			padding: 0 6px;
			box-sizing: border-box;
			border-radius: 5px;
		}
		a{
			text-decoration: none;
			text-align: center;
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
		<div class="header">	      
	      <h1>Online Voting System</h1>
	    </div>
		<h1 class="title">Login</h1>
		<a class="title" style="text-align: right; margin-top: -45px" href="../index.php"><h1>Home</h1> </a>
		<form action="include/functions.php" method="post" id="login-form" enctype="multipart/form-data">
			<!-- javascript:void(0) -->
			<div><span id="error"></span> </div>
			<input type="hidden" id="action" value="login">
			<label for="fname">Username / Identity Number</label>
			<input type="text" name="idno" id="idno" placeholder="Enter your ID NO." required>
			<span class="error" id="idno-error">Your username/Identity number is required</span>			

			<label for="password-insert">Password</label>
			<input type="password" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
			<span class="error" id="pass-error">Your password is required</span>

			<input class="btn" type="submit" id="submitbtn" name="login-btn" value="Login" required>
			
			<!-- <p class="success" id="success">Registered successfully</p>
			<p class="success" id="login-error" id="success">Invalid Username/Password</p> -->
		</form>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#idno-error').hide();
			$('#pass-error').hide();
			$('#idno').keyup(function(){
				validateId();
			});
			$('#password').keyup(function(){
				validatePass();
			});
			function validateId(){
				var id=$('#idno').val();
				if (id.length='') {
					$('#idno-error').show();
					return false;
				}else if(id.length<8){
					$('#idno-error').show();
					$('#idno-error').html('Identity number too short');
					return false;
				}else{
					$('#idno-error').hide();
				}
			}
			function validatePass(){
				var pass=$('#password').val();
				if (pass.length='') {
					$('#pass-error').show();
					return false;
				}else if(pass.length<4){
					$('#pass-error').show();
					$('#pass-error').html('Password too short');
					return false;
				}else{
					$('#pass-error').hide();
				}
			}

		})
	</script>

</body>
</html>