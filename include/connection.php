<?php
$host="localhost";
$user="root";
$password="";
$dbname="onlineVoting";

$conn=mysqli_connect($host,$user,$password,$dbname);
if (!$conn) {
	echo "<script>alert('Database connection error')</script>";
}


?>