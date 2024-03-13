<?php
include 'config.php';
$sql=mysqli_query($conn,"select * from sub_county where County_code='".$_GET["sid"]."'");
if (mysqli_num_rows($sql)) {
	$data=array();
	while($row=mysqli_fetch_array($sql)){
		$data[]=array(
			'id'=>$row['Code'],
			'sid'=>$row['County_code'],
			'name'=>$row['Name']
		);
	}
	header("Content-type: application/json");
	echo json_encode($data);
}

?>