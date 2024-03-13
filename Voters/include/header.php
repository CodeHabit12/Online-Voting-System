<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<script type="text/javascript" src="./../assets/jquery/jquery-3.6.3.min.js"></script>
<?php
@ include '../../include/connection.php';
// session_start();
if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];

	$query=mysqli_query($conn,"select * from voter_account where IdentityNo='$idno'");
	while ($row=mysqli_fetch_array($query)) {
		$email=$row['Email'];
		$status=$row['Status'];
	}
	
}

?>
<div class="nav-top">
	<ul>
		<a href="./index.php"><li>Home</li> </a>
		<a href="./results.php"><li>Results</li> </a>
		<a href="#"><li>Policy</li> </a>
		<a href="#"><li><?php echo $email; ?></li> </a>
		<a href="./logout.php"><li>Logout</li></a>		 
	</ul>
	
</div>
