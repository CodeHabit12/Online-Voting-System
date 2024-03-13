<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Candidate| Login Page</title>
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
		<form action="functions.php" method="post" id="login-form" enctype="multipart/form-data">
			<!-- javascript:void(0) -->
			<div><span id="error"></span> </div>
			<input type="hidden" id="action" value="login">
			<label for="fname">Username</label>
			<input type="text" name="idno" id="idno" placeholder="Enter your ID NO." required>
			<!-- <span class="error" id="idno-error">Your username is required</span>			 -->

			<label for="password-insert">Password</label>
			<input type="password" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
			<!-- <span class="error" id="pass-error">Your password is required</span> -->

			<input class="btn" type="submit" id="submitbtn" name="login-btn" value="Login">
			<a href="signup.php" class="btn">Dont have an account? Register</a>
			
			<!-- <p class="success" id="success">Registered successfully</p>
			<p class="success" id="login-error" id="success">Invalid Username/Password</p> -->
		</form>
	</div>
	<!-- <script type="text/javascript" src="include/validate.js"></script> -->

</body>
</html>