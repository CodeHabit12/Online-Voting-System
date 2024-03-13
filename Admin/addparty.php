<?php
@include '../include/connection.php';
$msg='';
session_start();
$idno=$_SESSION['idno'];
if ($idno) {
	if (isset($_POST['submit'])) {
	$name=mysqli_real_escape_string($conn,$_POST['name']);
	$code=mysqli_real_escape_string($conn,$_POST['code']);
	

	if (!empty($name) || !empty($code)) {
		$insert=mysqli_query($conn,"insert into political_parties(Name,Code) values('$name','$code')");
		if ($insert) {
			$msg="Data inserted successfully";
		}
		else{
			$msg="Data not inserted!";
		}
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
	<title>Add party</title>
	<link rel="stylesheet" type="text/css" href="./../assets/css/style.css">
</head>
<body>
	<div class="container">
		<?php include 'include/sidebar.php';  ?>
		<div class="main">
			<div class="index">
				<?php include 'include/header.php';  ?>
				<div class="form-data">
					<p>Add Party</p>
					<form action="" method="post">
						<div class="form-entry">
							<label>Party Name</label><br>
							<input type="text" name="name">
						</div>

						<div class="form-entry">
							<label>Party Code</label><br>
							<input type="text" name="code">
						</div>

						<div class="form-entry">
							<div class="btn-submit">
								<input type="submit" name="submit" placeholder="Submit">
							</div>
						</div>

						<div class="msg">
							<p><?php echo $msg  ?>  </p>
						</div>
					</form>
					
				</div>
				
			</div>
		</div>
	</div>

</body>
</html>