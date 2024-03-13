<?php
@ include '../include/connection.php';
session_start();
if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];
	$title=mysqli_fetch_array(mysqli_query($conn, "select Election_Name from election"))[0];

	$query=mysqli_query($conn,"select * from voter_account, id_table where voter_account.IdentityNo='$idno' and id_table.IdentityNo=voter_account.IdentityNo");
	while ($row=mysqli_fetch_array($query)) {
		$name=$row['Name'];
		$phone=$row['phone'];
		$email=$row['Email'];
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
	<title>Voter Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
	<script type="text/javascript" src="../assets/javascript/time.js"></script>
</head>
<body>
	<div class="container">
	<?php include 'include/sidebar.php'   ?>
	<div class="main">

	<div class="index">
		<?php include 'include/header.php' ?>
		<div class="dash">
				<marquee><p style="font-style: bold; font-size: 24px"><?php echo $title; ?></p>	</marquee>			
			</div>
		
		<div class="btn">
			<a href="register.php">
				<div class="vote">
					<p>Register to vote</p>
				</div>
			</a>

			<a id="status" href="#">
				<div class="vote">
					<p>My vote status</p>
				</div>
			</a>

			<a href="home.php">
				<div class="vote">
					<p>Current election</p>
				</div>
			</a>

			<a href="updateAccount.php">
				<div class="vote">
					<p>My account</p>
				</div>
			</a>
			<a href="result.php">
				<div class="vote">
					<p>Election Results</p>
				</div>
			</a>
		</div>	
		<div class="home">
			<?php include 'time.php' ?>		
		</div>
		<div class="home-class">
			<h1>Online Voting System</h1>
			
			<img src="../assets/images/adobe.jpg">
			<img src="../assets/images/adobe.jpg">
			<img src="../assets/images/adobe.jpg">				
		</div>

			</div>
		</div>
	</div>
</body>
</html>