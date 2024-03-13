<?php
include '../include/connection.php';

if (!empty($_POST['county_id'])) {
	$query=mysqli_query($conn,"select * from constituencies where County_code=".$_POST['county_id']."");
	if (mysqli_num_rows($query)>0) {
		echo '<option value="">Select constituency</option>';
		while ($row=mysqli_fetch_assoc($query)) {
			echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
		}
	}else{
		echo '<option value="">Ward not available</option>';
	}
}elseif (!empty($_POST["constituency_id"])) {
	$query=mysqli_query($conn,"select * from ward where subcounty_code=".$_POST['constituency_id']."");
	if (mysqli_num_rows($query)>0) {
		echo '<option value="">Select ward</option>';
		while ($row=mysqli_fetch_assoc($query)) {
			echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
		}
	}else{
		echo '<option value="">Ward not available</option>';
	}
}

?>