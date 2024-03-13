<?php
$conn=mysqli_connect('localhost','root','','online_voting') or die('Error connecting');
include 'counties.php';
$query=mysqli_query($conn,"select count(IdentityNo) as Voters from uservotelocation where uservotelocation.County='$voter'");

$record=array();
while($row=mysqli_fetch_assoc($query)){
	$record[]=$row;
}

print(json_encode($record));
mysqli_free_result($query);
mysqli_close($conn);

?>