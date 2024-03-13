<?php
@include '../include/connection.php';
session_start();
// edit_user();

	$id=$_GET['view-Id'];
	$start='';
	$desc='';
	$end='';
	

	$sql=mysqli_query($conn,"SELECT * from `timeline` where Id='$id'");
	while ($row=mysqli_fetch_array($sql)) {
		$desc=$row['Description'];
		$start=$row['startDate'];
		$end=$row['endDate'];
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
					<h1 class="title">Edit Timeline</h1>
					<form action="" method="post" id="registration" enctype="multipart/form-data">
						<div><span id="error"></span> </div>

						<label for="lname">Description</label>
						<input type="text" name="description" id="lastname" value="<?php echo $desc ?>">
						<!-- <span class="error" id="lname-error">Your last name is required</span> -->

						<label for="emaill">Start Date</label>
						<input type="date" name="startdate" id="email" value="<?php echo $start ?>">
						<!-- <span class="error" id="email-error">Your email is required</span> -->

						<label for="idno">End Date</label>
						<input type="date" name="enddate" value="<?php echo $end ?>">
						<!-- <span class="error" id="idno-error">Your identity number is required</span> -->
						
						<input class="bt" type="submit" id="submitbtn" name="update-time" value="Submit">
						
					</form>

					<a style="font-size: 24px; margin-top: 10px" href="setting.php">Back</a>
				</div>
			</div>
			
		</div>
	</div>
	<!-- <script type="text/javascript" src="include/validate.js"></script> -->
	<!-- <script type="text/javascript" src="jquery/jquery-3.6.3.min.js"></script> -->

</body>
</html>
<?php
if (isset($_POST['update-time'])) {
	$desc=mysqli_real_escape_string($conn,$_POST['firstname']);
	$start=mysqli_real_escape_string($conn,$_POST['lastname']);
	$end=mysqli_real_escape_string($conn,$_POST['email']);
	

	$update=mysqli_query($conn,"update `timeline` set Description='$desc',startDate='$start',endDate='$end' where Id='$Id'");
	if ($update) {
		echo "<script>alert('Update successful')</script>";
	}else{
		echo "<script>alert('Update failed. Please attempt again')</script>";
	}
}
?>


