<?php
include 'include/connection.php';

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Contacts| Claims</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
	<style type="text/css">
		.contain{
			width: 600px;
			margin: 25px auto;
		}
		.contain .title{
			margin-bottom: 1rem;
		}
		.contain form{
			padding: 20px;
			background: #2c3e50;
			color: #fff;
			break-after: 5px;
			border-radius: 5px;
		}
		.contain form input,
		.contain form label,
		.contain form button,
		.contain span,
		.contain a,
		textarea{
			border: 0;
			margin-bottom: 3px;
			display: block;
			width: 100%;
			font-size: 20px;
		}
		.contain a{
			text-decoration: none;
			text-align: center;
		}
		.contain form input,
		.contain select,
		.contain a{
			height: 30px;
			line-height: 30px;
			background: fff;
			color: #000;
			padding: 0 6px;
			font-size: 18px;
			box-sizing: border-box;
			border-radius: 5px;
		}
		.contain textarea{
			border-radius: 5px;
			font-size: 18px;
		}
		.contain form .btnn{
			height: 30px;
			line-height: 30px;
			background: #e67e22;
			color: #fff;
			text-transform: uppercase;
			font-weight: bold;
			margin-top: 1.5rem;
			cursor: pointer;
		}
		.contain form .error{
			color: #ff0000;
		}
	</style>
</head>
<body>
	<div class="container" style="display: block;">
    	<div class="header">
	      <img src="https://cdn-icons-png.flaticon.com/512/888/888879.png" alt="Online voting logo">
	      <h1>Online Voting System</h1>
	      <img src="https://cdn-icons-png.flaticon.com/512/888/888879.png" alt="Online voting logo">
	    </div>
	    <div class="nav">
	      <a href="index.php">Home</a>
	      <a href="about.php">About</a>
	      <a href="admin/login.php">Admin</a>
	      <a href="Candidate/login.php">Candidate</a>
	      <a href="Voters/login.php">Voter</a>
	      <a href="contact.php">Contact</a>
	    </div>
	    <div class="mainDiv">
	     <div class="contain">
			<form action="functions.php" method="post" id="registration" enctype="multipart/form-data">
				<div><span id="error"></span> </div>
				<label for="fname">Name</label>
				<input type="text" name="name" id="name" >
				<!-- <span class="error" id="fname-error">Your first name is required</span> -->

				<label for="lname">Identity Number</label>
				<input type="text" name="idno" id="idno" >
				<!-- <span class="error" id="lname-error">Your last name is required</span> -->

				<label for="emaill">Email</label>
				<input type="email" name="email" id="email" >
				<!-- <span class="error" id="email-error">Your email is required</span> -->

				<label for="message">Message</label>
				<textarea rows="4" placeholder="Insert your claims/comments here" name="message"></textarea>

				<label for="attach">Attach file(Optional)</label>
				<input type="file" name="document">

				<!-- <button type="submit" id="submitbtn" name="submit">Register</button> -->
				<input class="btnn" type="submit" id="submitbtn" name="submit-message" value="Submit">
				
			</form>
		</div>
	   </div>
	   <div class="footer">
	     <p>© Online Voting System. All rights reserved.</p>
	   </div>
 	</div>	

</body>
</html>

