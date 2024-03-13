<?php
include 'config.php';

$sql=mysqli_query($conn,"select * from counties");
if (mysqli_num_rows($sql)) {
	$data=array();
	while($row=mysqli_fetch_array($sql)){
		$data[]=array(
			'id' => $row['Code'],
			'name' => $row['Name']
		);
	}
	header('Content-type:application/json');
	echo json_encode($data);
}


?>