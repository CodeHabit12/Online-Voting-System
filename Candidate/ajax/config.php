<?php
$conn=mysqli_connect('localhost','root','','online_voting');
if (!$conn) {
	echo "<script>alert('Database connection error')</script>";
}


?>