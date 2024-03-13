<?php
@include '../include/connection.php';
session_start();
if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];
	
	if (isset($_GET['view-Id'])) {
		$id=$_GET['view-Id'];
		$sql=mysqli_query($conn,"SELECT voter_account.id,id_table.Name,voter_account.IdentityNo,voter_account.Phone,voter_account.Email,id_table.Gender,voter_account.Profile,id_table.IdentityNo,voter_account.Id_Front,voter_account.Id_Back from voter_account,id_table where voter_account.IdentityNo=id_table.IdentityNo and voter_account.id='$id'");
		foreach ($sql as $row) {
			$name=$row['Name'];
			$email=$row['Email'];
			$phone=$row['Phone'];
			$gender=$row['Gender'];
			$voterid=$row['IdentityNo'];
			$img=$row['Profile'];
			$front=$row['Id_Front'];
			$back=$row['Id_Back'];
			// $fname=$row['fname'];
		}
	}else{
		echo "<script>Not gotten</script>";
	}
	
	

}else{
	echo "<script>location.href='login.php'</script>";
}
// edit_user();

	


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<style type="text/css">
		
		.container-edit{
			width: 700px;
			margin: 25px auto;
		}
		.title{
			margin-bottom: 1rem;
		}
		.container-edit form{
			padding: 20px;
			background: #2c3e50;
			color: #fff;
			break-after: 5px;
			border-radius: 5px;
		}
		.container-edit form input,
		.container-edit form label,
		.container-edit form button,
		.container-edit span,
		.container-edit select,
		.container-edit a{
			border: 0;
			margin-bottom: 3px;
			display: block;
			width: 100%;
		}
		.container-edit a{
			text-decoration: none;
			text-align: center;
		}
		.container-edit form input,
		.container-edit select,
		.container-edit a{
			height: 35px;
			line-height: 30px;
			background: fff;
			color: #000;
			font-size: 20px;
			padding: 0 6px;
			box-sizing: border-box;
			border-radius: 5px;
		}
		.container-edit form .bt{
			height: 30px;
			line-height: 30px;
			background: #e67e22;
			color: #fff;
			text-transform: uppercase;
			font-weight: bold;
			margin-top: 1.5rem;
			cursor: pointer;
		}
		.container-edit form .error{
			color: #ff0000;
		}
	</style>
</head>
<body>
	<div class="container">
		<?php include 'include/sidebar.php'; ?>
		<div class="main">
			<div class="index">
				<?php include 'include/header.php'; ?>

				<div class="container-edit">
					<h1 class="title">Details</h1>
					<form action="functions.php" method="post" id="registration" enctype="multipart/form-data">
						<div><span id="error"></span> </div>

						<label for="lname">Name</label>
						<input type="text" name="lastname" disabled id="lastname" value="<?php echo $name ?>">
						<!-- <span class="error" id="lname-error">Your last name is required</span> -->

						<label for="emaill">Email Name</label>
						<input type="email" name="email" disabled id="email" value="<?php echo $email ?>">
						<!-- <span class="error" id="email-error">Your email is required</span> -->

						<label for="idno">Identity Number</label>
						<input type="number" name="idno" id="idno" value="<?php echo $voterid ?>">
						<!-- <span class="error" id="idno-error">Your identity number is required</span> -->

						<label for="phoneNo">Phone Number</label>
						<input type="phone" name="phone" disabled id="phone" value="<?php echo $phone ?>">
						<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

						<div>
							<div style="">
								<label for="upload-img">Profile Picture</label>
								<img style="width: 320px; height: 200px;" src="../assets/images/<?php echo $img; ?>">
							</div>
						</div>

						<div style="display: flex;">
							<div style="margin-right: 10px; align-items: center;">
								<label for="upload-img">Id image(Front)</label>
								<img style="width: 320px; height: 200px;" src="../assets/images/<?php echo $front; ?>">
							</div>

							<div style="margin-right: 10px;">
								<label for="upload-img">Id image(Back)</label>
								<img style="width: 320px; height: 200px;" src="../assets/images/<?php echo $back; ?>">
							</div>				
						</div>
						<input type="submit" name="confirm-allow" id="enable" class="bt" value="Enable">						
					</form>
				</div>
				
			</div>
		</div>
	</div>
	<!-- <script type="text/javascript" src="include/validate.js"></script> -->
	<!-- <script type="text/javascript" src="jquery/jquery-3.6.3.min.js"></script> -->

</body>
</html>
<?php
if (isset($_POST['update-user'])) {
	$fname=mysqli_real_escape_string($conn,$_POST['firstname']);
	$lname=mysqli_real_escape_string($conn,$_POST['lastname']);
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$idno=mysqli_real_escape_string($conn,$_POST['idno']);
	$phone=mysqli_real_escape_string($conn,$_POST['phone']);
	// $=mysqli_real_escape_string($conn,$_POST['firstname']);

	$front_image = $_FILES['front_image']['name'];
    $p_image_tmp_name = $_FILES['front_image']['tmp_name'];
    $p_image_folder = '../assets/images/voter/'.$front_image;

	$update=mysqli_query($conn,"update voter_account set fname='$fname',lname='$lname',Email='$email',Phone='$phone',Id_No='$idno',image_profile='$front_image' where Id='$Id'");
	if ($update) {
		echo "<script>alert('Update successful')</script>";
	}else{
		echo "<script>alert('Update failed. Please attempt again')</script>";
	}
}
?>


