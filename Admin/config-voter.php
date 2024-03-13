<?php
@include '../include/connection.php';
session_start();
// edit_user();

	$id=$_GET['view-Id'];
	$name='';
	$email='';
	$phone='';
	$gender='';
	$idno='';
	$img='';

	$sql=mysqli_query($conn,"SELECT voter_account.id,id_table.Name,voter_account.IdentityNo,voter_account.Phone,voter_account.Email,id_table.Gender,voter_account.Profile,id_table.IdentityNo,voter_account.Id_Front,voter_account.Id_Back from voter_account,id_table where voter_account.IdentityNo=id_table.IdentityNo and voter_account.id='$id'");
	while ($row=mysqli_fetch_array($sql)) {
		$name=$row['Name'];
		$email=$row['Email'];
		$phone=$row['Phone'];
		$gender=$row['Gender'];
		$voterid=$row['IdentityNo'];
		$img=$row['Profile'];
		// $fname=$row['fname'];
	}



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
					<h1 class="title">Edit you details then submit</h1>
					<form action="" method="post" id="registration" enctype="multipart/form-data">
						<div><span id="error"></span> </div>

						<label for="lname">Name</label>
						<input type="text" name="lastname" id="lastname" value="<?php echo $name ?>">
						<!-- <span class="error" id="lname-error">Your last name is required</span> -->

						<label for="emaill">Email Name</label>
						<input type="email" name="email" id="email" value="<?php echo $email ?>">
						<!-- <span class="error" id="email-error">Your email is required</span> -->

						<label for="idno">Identity Number</label>
						<input type="number" name="idno" disabled id="idno" value="<?php echo $voterid ?>">
						<!-- <span class="error" id="idno-error">Your identity number is required</span> -->

						<label for="phoneNo">Phone Number</label>
						<input type="phone" name="phone" id="phone" value="<?php echo $phone ?>">
						<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

						<label for="upload-img">Upload Image</label>
						<img style="width: 200px; height: 100px;" src="../assets/images/voter/<?php echo $img; ?>">
						<input type="file" name="front_image" id="profile" accept="image/png, image/jpg, image/jpeg"required>
						<!-- <span class="error" id="upload-error">Please upload your image</span> -->
						<!-- <span class="error" id="gender-error">Please select your gender</span> -->

						<!-- <button type="submit" id="submitbtn" name="submit">Register</button> -->
						<input class="bt" type="submit" id="submitbtn" name="update-user" value="Submit">
						
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


