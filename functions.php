<?php
@ include 'include/connection.php';
if (isset($_POST['submit-message'])) {
	message();
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

	$sql=mysqli_query($conn,"insert into message(Sender_Name, Sender_Id, Sender_Email, message, Document) values('$name','$idno','$email','$message','$attachment')");

	if ($sql) {
		move_uploaded_file($p_image_tmp_name, $p_image_folder);
		echo "<script>alert('Submitted successfully')</script>";
		echo "<script>location.href='contact.php'</script>";
	}else{
		echo "<script>alert('Not Submitted')</script>";
	}

}






?>