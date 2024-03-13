<?php
session_start();
include '../include/connection.php';
$id=$_SESSION['idno'];
if ($id) {
	$sql=mysqli_query($conn,"select * from candidate, id_table where candidate.IdentityNo='$id' and candidate.IdentityNo=id_table.IdentityNo");
	if (mysqli_num_rows($sql)>0) {
		while ($row=mysqli_fetch_array($sql)) {
			$name=$row['Name'];
			$idno=$row['IdentityNo'];
			$email=$row['Email'];
			$phone=$row['Phone'];
			$party=$row['Political_Party'];
			$img=$row['Profile'];
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
	<title>Sign Up</title>
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
		<?php include 'sidebar.php';  ?>
		<div class="main">
			<div class="index">
				<?php include 'topbar.php';  ?>
				<div class="btn">


					<a href="index.php">
						<div class="vote">
							<p>Current election</p>
						</div>
					</a>

					<a href="edit-cand.php">
						<div class="vote">
							<p>Update my account</p>
						</div>
					</a>

					<a href="contact.php">
						<div class="vote">
							<p>Claims</p>
						</div>
					</a>

					<a href="results.php">
						<div class="vote">
							<p>Results</p>
						</div>
					</a>
				</div>
				<div class="contain">
					<!-- <h1 class="title">Registration</h1> -->
					<form action="functions.php" method="post" id="registration" enctype="multipart/form-data">
						<div><span id="error"></span> </div>
						<label for="fname">Name</label>
						<input type="text" disabled name="name" id="name" value="<?php echo $name;  ?>">
						<!-- <span class="error" id="fname-error">Your first name is required</span> -->

						<label for="lname">Identity Number</label>
						<input type="text" disabled name="idno" id="idno" value="<?php echo $idno;  ?>">
						<!-- <span class="error" id="lname-error">Your last name is required</span> -->

						<label for="emaill">Email</label>
						<input type="email" disabled name="email" id="email" value="<?php echo $email;  ?>">
						<!-- <span class="error" id="email-error">Your email is required</span> -->

						<label for="phoneNo">Phone Number</label>
						<input type="phone" disabled name="phone" id="phone" value="<?php echo $phone;  ?>">
						<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

						
						<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

						<label for="phoneNo">Political Party</label>
						<input type="text" disabled name="party" id="party" value="<?php echo $party;  ?>">
						<label>Profile Picture</label>
						<img style="width: 200px; height: 100px;" src="./../assets/images/candidate/<?php echo $img; ?>">
						
						
					</form>
				</div>

			</div>
		</div>
	</div>
	<!-- <script type="text/javascript" src="include/validate.js"></script> -->
	<!-- <script type="text/javascript" src="jquery/jquery-3.6.3.min.js"></script> -->

</body>
</html>