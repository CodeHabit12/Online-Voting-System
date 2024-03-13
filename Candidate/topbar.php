<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<?php
@ include '../../include/connection.php';
// session_start();
if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];

	$query=mysqli_query($conn,"select * from candidate, id_table where candidate.IdentityNo='$idno' and candidate.IdentityNo=id_table.IdentityNo");
	while ($row=mysqli_fetch_array($query)) {
		// $name=$row['fname'];
		// $phone=$row['Phone'];
		$email=$row['Email'];
		// $seat=$row['Seat'];
	}
}

?>
<nav class="nav-top">
	<ul>
		<a href="index.php"><li>Home</li> </a>
		<a href="#"><li>About Us</li> </a>
		<a href="index.php"><li><?php echo $email;  ?></li> </a>
		<!-- <a href="login.php"><li><?php echo $seat;  ?></li> </a> -->
		<a href="logout.php"><li>Logout</li> </a>
	</ul>				
</nav>