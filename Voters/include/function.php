<?php
@include '../../include/connection.php';
session_start();

if (isset($_POST['register-btn'])) {
	register();
}else if (isset($_POST['login-btn'])) {
	login();
}
function register(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	
	$idno = mysqli_real_escape_string($conn, validateData($_POST['idno']));
	$email = mysqli_real_escape_string($conn, validateData($_POST['email']));
	$phone = mysqli_real_escape_string($conn, validateData($_POST['phone']));
	$password = mysqli_real_escape_string($conn, validateData($_POST['password']));
	$cpassword = mysqli_real_escape_string($conn, validateData($_POST['cpassword']));

	$profilePik = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = '../../assets/images/voter/'.$profilePik;

	$front_image = $_FILES['front_image']['name'];
    $f_image_tmp_name = $_FILES['front_image']['tmp_name'];
    $f_image_folder = '../../assets/images/voter/'.$front_image;

    $back_image = $_FILES['back_image']['name'];
    $b_image_tmp_name = $_FILES['back_image']['tmp_name'];
    $b_image_folder = '../../assets/images/voter/'.$back_image;

    

    $query=mysqli_query($conn,"select * from id_table where IdentityNo='$idno'");
    if (mysqli_num_rows($query)>0) {

    	$queryUser=mysqli_query($conn,"select * from voter_account where IdentityNo='$idno'");
    	if (mysqli_num_rows($queryUser)>0) {
    		echo "<script>alert('Account already exists. For enqueries contact the administrator.')</script>";
    		echo "<script>location.href='../../contact.php'</script>";
    	}else{
    		if ($password==$cpassword) {
		    	$insert=mysqli_query($conn,"INSERT INTO voter_account(`IdentityNo`, `phone`, `Email`, `Profile`, `Id_Front`, `Id_Back`, `reg_date`, `reg_time`, `Password`, `Status`, `Voted`) values('$idno', '$phone', '$email', '$profilePik', '$front_image', '$back_image', CURDATE(), CURTIME(), '$password', 0,0)");

		    	if ($insert) {
					move_uploaded_file($p_image_tmp_name, $p_image_folder);
					move_uploaded_file($f_image_tmp_name, $f_image_folder);
					move_uploaded_file($b_image_tmp_name, $b_image_folder);
					echo "<script>alert('Registration successful')</script>";
					echo "<script>location.href='http://localhost/Online%20Voting%20System/Voters/login.php'</script>";
				}
				else{
					echo "<script>alert('Registration unsuccessful')</script>";
					echo mysqli_error($conn);
					echo "<script>location.href='../signup.php'</script>";
				}
		    }

    	}

    	
    	
    }else{
    	echo "<script>alert('Identity Number not recognized. Try again')</script>";
    	echo "<script>location.href='./signup.php'</script>";
    }
}

function login(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$username = mysqli_real_escape_string($conn,validateData($_POST['username']));
	$password = mysqli_real_escape_string($conn,validateData($_POST['password']));


	if (!empty($username) && !empty($password)) {
		$query=mysqli_query($conn, "select * from voter_account where IdentityNo='$username'");
		
		$sql=mysqli_query($conn,"select * from voter_account where IdentityNo='$username' && Password='$password'");
		if (mysqli_num_rows($sql)>0) {
			while ($row=mysqli_fetch_assoc($sql)) {
				$status=$row['Status'];
			}
			?>
			<script type="text/javascript">
				var value=<?php echo $status; ?>;
				alert(value);
				if (value==0) {
					alert('Account still under review');
					window.location.href='../../index.php';
				}
				else if (value==1) {
					alert('Login successful');
					window.location.href='../index.php';
					<?php
					$_SESSION['idno']=$username;
					?>
				}
			</script>
			<?php
		}
		
	}
	

}

?>