<?php
include '../include/connection.php';

if (isset($_POST['submitVotepres'])) {
	votePresident();
}	

function votePresident(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$preId=mysqli_real_escape_string($conn,$_POST['presidentID']);
	$query=mysqli_query($conn,"insert into voting(Id_No,President) values('$voterID','$preId')");
	if ($query) {
		echo "<script>alert('Congatulation, you have voted');</script>";
	}else{
		echo "<script>echo('Error. Presidential vote was not submitted')</script>";
	}
	
}





?>