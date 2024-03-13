<?php

include '../include/connection.php';
session_start();
$idno=$_SESSION['idno'];
if (isset($idno)) {
	$sql=mysqli_query($conn,"select * from voter_account, id_table where voter_account.IdentityNo='$idno' and id_table.IdentityNo=voter_account.IdentityNo");
	if (mysqli_num_rows($sql)>0) {
		while ($row=mysqli_fetch_array($sql)) {
			$name=$row['Name'];
			$idno=$row['IdentityNo'];
			$email=$row['Email'];
			$phone=$row['phone'];
			$image=$row['Profile'];
		}
	}
}else{
	echo "<script>location.href='login.php'</script>";
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Voter | My account</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
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
		.contain a{
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
	<div class="container">
		<?php include 'include/sidebar.php';  ?>
		<div class="main">
			<div class="index">
				<?php include 'include/header.php';  ?>
				<div class="candAlign" style="margin-bottom: 10px">

					<div class="dashb">
						<label>Election data centre- Election Timeline</label>
						<input type="search" name="search" id="live_search" placeholder="Search">					
					</div>

					<div class="box" id="loginClick" >
						<p>Candidate Login Credentials</p>
						<p>View</p>
					</div>
					
					<div class="box" id="updateClick">
						<p>Account Update</p>
						<p>Edit</p>
						
					</div>				
				</div>
				<center>
					<div class="party" id="credentialsDiv">
						<h2 style="font-style: italic; font-size: 30px;">View login credentials to your candidates page</h2>
						<div class="viewDetails">
							<?php  
							$sql=mysqli_query($conn, "select * from candidate where IdentityNo='$idno'");
							if (mysqli_num_rows($sql)>0) {
								while ($row=mysqli_fetch_assoc($sql)) {
									?>
									<label>Username: </label>
									<h2><?php  echo $row['IdentityNo'] ?></h2><br>
									<label>Password: </label>
									<h2><?php echo $row['Password']; ?></h2>
									<?php 
								}
							}else{
								?>
								<script type="text/javascript">
									$(document).ready(function(){
										$("#credentialsDiv").css('display', 'none');
										alert('Unauthorized');
									})
								</script>
								<?php 
							}
							?>
							
						</div>
					</div>
				</center>
				<div class="contain" id="updateDiv" style="display: none;">					
					<h1 class="title">Update Account</h1>
					<form action="functions.php" method="post" id="registration" enctype="multipart/form-data">

						<div><span id="error"></span> </div>
						<label for="fname">Name</label>
						<input type="text" name="name" id="name" value="<?php echo $name;  ?>">
						<!-- <span class="error" id="fname-error">Your first name is required</span> -->

						<label for="lname">Identity Number</label>
						<input type="text" name="idno" id="idno" value="<?php echo $idno;  ?>">
						<!-- <span class="error" id="lname-error">Your last name is required</span> -->

						<label for="emaill">Email</label>
						<input type="email" name="email" id="email" value="<?php echo $email;  ?>">
						<!-- <span class="error" id="email-error">Your email is required</span> -->

						<label for="phoneNo">Phone Number</label>
						<input type="phone" name="phone" id="phone" value="<?php echo $phone;  ?>">
						<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

						<label>Profile Picture</label>
						<img style="width: 200px; height: 100px;" src="./../assets/images/voter/<?php echo $image; ?>">

						<!-- <label for="phoneNo">Political Party</label>
						<input type="text" name="party" id="party" value="<?php echo $party;  ?>"> -->
						<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

						<!-- <button type="submit" id="submitbtn" name="submit">Register</button> -->
						<input class="btnn" type="submit" id="submitbtn" name="submit-btn" value="Update">
						
					</form>
				</div>

			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#loginClick').on('click', function(){
				$('#credentialsDiv').css('display', 'block');
				$('#updateDiv').css('display', 'none');
			})

			$('#updateClick').on('click', function(){
				$('#credentialsDiv').css('display', 'none');
				$('#updateDiv').css('display', 'block');
			})
		})
	</script>

</body>
</html>