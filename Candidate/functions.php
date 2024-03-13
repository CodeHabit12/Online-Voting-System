<?php
@ include '../include/connection.php';
session_start();
if (isset($_POST['login-btn'])) {
	login();
}
if (isset($_POST['submit-message'])) {
	message();
}
if (isset($_POST['update-btn'])) {
	update_cand();
	// code...
}
function update_cand(){
	global $conn;
	function validateData($data){
		$resultData=htmlspecialchars(stripcslashes(trim($data)));
		return $resultData;
	}
	$idno = mysqli_real_escape_string($conn, validateData($_POST['idno']));
	$email = mysqli_real_escape_string($conn, validateData($_POST['email']));
	$phone = mysqli_real_escape_string($conn, validateData($_POST['phone']));
	$front_image = $_FILES['profile_img']['name'];
    $p_image_tmp_name = $_FILES['profile_img']['tmp_name'];
    $p_image_folder = '../assets/images/candidate/'.$front_image;

    $update=mysqli_query($conn,"UPDATE candidate set Email='$email',Phone='$phone',image='$front_image' where Id_No='$idno'");
    if ($update) {
    	echo "<script>alert('Updated successfully')</script>";
    	echo "<script>location.href='index.php'</script>";
    }else{
    	echo "<script>alert('Records Not Updated')</script>";
    }
	
}
function login(){
	global $conn;
	$idno = mysqli_real_escape_string($conn, $_POST['idno']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	if (!empty($idno) && !empty($password)) {
		$sql=mysqli_query($conn,"select * from candidate where IdentityNo='$idno' && Password='$password'");
		$count=mysqli_num_rows($sql);
		if ($count==1) {
			$_SESSION['idno']=$idno;
			echo "<script>alert('Login successful')</script>";
			echo "<script>location.href='index.php'</script>";
		}else{
			echo "<script>alert('Login unsuccessful')</script>";
			echo "<script>location.href='login.php'</script>";
		}
	}

}
function message(){
	global $conn;

	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}

	$name=mysqli_real_escape_string($conn, validateData($_POST['name']));
	$idno=mysqli_real_escape_string($conn, validateData($_POST['idno']));
	$email=mysqli_real_escape_string($conn, validateData($_POST['email']));
	$message=mysqli_real_escape_string($conn, validateData($_POST['message']));
	// $attachment=validateData($_POST['document']);

	$attachment = $_FILES['document']['name'];
	$p_image_tmp_name = $_FILES['document']['tmp_name'];
	$p_image_folder = '../assets/doc/candidate/'.$attachment;

	$sql=mysqli_query($conn,"insert into candmsgs(Sender_Name, Sender_Id, Sender_Email, message, Document) values('$name','$idno','$email','$message','$attachment')");

	if ($sql) {
		move_uploaded_file($p_image_tmp_name, $p_image_folder);
		echo "<script>alert('Submitted successfully')</script>";
		echo "<script>location.href='contact.php'</script>";
	}else{
		echo "<script>alert('Not Submitted')</script>";
	}

}

?>