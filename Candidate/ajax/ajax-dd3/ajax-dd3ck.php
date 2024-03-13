<?Php
require "config.php"; // connection details

error_reporting(0);// With this no error reporting will be there
//////////
/////////////////////////////////////////////////////////////////////////////
$country=$_GET['country'];// 
//$country='IND'; // To check you can use this
$state1=$_GET['state'];
$city1=$_GET['city'];
//$state1="Andhra Pradesh";
///////////// Validate the inputs ////////////
// Checking country variable ///
if((strlen($country)) > 0 and (!ctype_alpha($country))){ 
echo "Data Error";
exit;
}
// Checking state variable (with space ) ///

if ((strlen($state1)) > 0 and ctype_alpha(str_replace(' ', '', $state1)) === false) {
echo "Data Error";
exit;
}

/////////// end of input validation //////

if(strlen($country) > 0){
$q_country="select distinct(state) from student5 where country = '$country'";
}else{
$q_country="select distinct(state) from student5";
}
//echo $q_country;
$sth = $dbo->prepare($q_country);
$sth->execute();
$state = $sth->fetchAll(PDO::FETCH_COLUMN);

$q_state="select distinct(city) from student5 where ";
if(strlen($country) > 0){
$q_state= $q_state . " country = '$country' ";
}
if(strlen($state1) > 0){$q_state= $q_state . " and  state='$state1'";}
$sth = $dbo->prepare($q_state);
$sth->execute();
$city = $sth->fetchAll(PDO::FETCH_COLUMN);

$main = array('state'=>$state,'city'=>$city,'value'=>array("state1"=>"$state1","city1"=>"$city1"));
echo json_encode($main); 

////////////End of script /////////////////////////////////////////////////////////////////////////////////
?>