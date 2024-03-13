<?php
@include '../include/connection.php';
?>
<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
<?php

if (isset($_GET['delete_Id'])) {
	$id=$_GET['delete_Id'];
	$delete=mysqli_query($conn,"delete from voter_account where id='$id'");

	if ($delete) {
		echo "<script>alert('Data deleted successfully')</script>";
		echo "<script>location.href='voter.php'</script>";
	}
}
if (isset($_GET['delete_pos'])) {
	$id=$_GET['delete_pos'];
	$delete=mysqli_query($conn,"delete from elective_seats where Id='$id'");

	if ($delete) {
		echo "<script>alert('Data deleted successfully')</script>";
		echo "<script>location.href='positions.php'</script>";
	}
}
else if (isset($_GET['delete_cand_Id'])) {
	$id=$_GET['delete_cand_Id'];
	$delete=mysqli_query($conn,"delete from candidate where id='$id'");
	if ($delete) {
		echo "<script>alert('Data deleted successfully')</script>";
		echo "<script>location.href='candidates.php'</script>";
	}
}
if (isset($_POST['input'])) {
	$input=$_POST['input'];

	$query="SELECT * from candidate, id_table where id_table.IdentityNo=candidate.IdentityNo and Name like '{$input}%' OR id_table.IdentityNo like '{$input}%' OR Email like '{$input}%' or Phone like '{$input}%' or Gender like '{$input}%' or Position_id like '{$input}%'";

	$result=mysqli_query($conn, $query);
	if (mysqli_num_rows($result)>0) {
		?>
		<div class="party">
			<div class="party" id="allDiv" style="display: block;">
				<div class="party-top">
					<p>Registered candidates- All</p>
				</div>
				<table>
					<tr>
						<th width="50px">#</th>
						<th>Name</th>
						<th>Id No.</th>
						<th>Email</th>
						<th>Phone Number</th>							
						<th>Party Code</th>
						<th>Action</th>
					</tr>
					<?php					
					$sn=1;
					while ($data=mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td><?php echo $sn;  ?></td>
							<td><?php echo $data['Name'];  ?></td>
							<td><?php echo $data['IdentityNo'];  ?></td>
							<td><?php echo $data['Email'];  ?></td>
							<td><?php echo $data['Phone'];  ?></td>
							<td><?php echo $data['Political_Party'];  ?></td>
							
							<td>
								<form method="post" accept="">
									<a href="view-candidate.php?view-Id=<?php echo $data['Id'] ?>">
										<button type="button" name="view-cand">View</button>
									</a>

									<a href="edit-cand.php?view-Id=<?php echo $data['Id'] ?>">
										<button type="button" name="view-cand">Edit</button>
									</a>

									<a href="functions.php?delete_cand_Id=<?= $data['Id'] ?>">
										<button onclick="return confirm('Are you sure you want to delete this?')" type="button" name="view-cand">Delete</button>
									</a>
								</form>
							</td>
							
						</tr>
						<?php
						$sn++;
					}
					
					

					?>
				</table>
				
			</div>
		</div>
		<?php
	}else{
		echo "<h2>No data found</h2>";
	}
}
if (isset($_POST['county_search'])) {
	$county=$_POST['county_search'];

	$query="SELECT * from counties where Name like '{$county}%' OR Hotline_Email like '{$county}%' or Code like '{$county}'";

	$result=mysqli_query($conn, $query);

	if (mysqli_num_rows($result)>0) {
		?>
		<div class="party">
			<table>
				<tr>
					<th width="50px">#</th>
					<th>County Name</th>
					<th>County Code</th>
					<th>Email</th>
					<th>Reg Voters</th>
					<th>Action</th>
				</tr>
				<?php
				
				$sn=1;
				while ($data=mysqli_fetch_assoc($result)) {
					$id=$data['Code'];
					$voter=mysqli_fetch_array(mysqli_query($conn, "select count(IdentityNo) from Location where County='$id'"))[0];
					?>
					<tr>
						<td><?php echo $sn;  ?></td>
						<td><?php echo $data['Name'];  ?></td>
						<td><?php echo '0'.$data['Code'];  ?></td>
						<td><?php echo $data['Hotline_Email'];  ?></td>
						<td><?php echo $voter;  ?> Voters</td>
						<td>
							<form method="post" accept="">
								<a href="view-county.php?view-Id=<?= $data['Code'] ?>">
									<button style="width: 100%; height: 100%;" type="button" name="view-cand">View Details</button>
								</a>											
							</form>
						</td>
						
					</tr>
					<?php
					$sn++;
				}
				
				

				?>
			</table>
			
		</div>
		<?php
	}
}
if (isset($_POST['confirm-allow'])) {
	voter_allow();
}
if (isset($_POST['edit-candidate'])) {
	edit_cand();
}


function voter_allow(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$voterid=mysqli_real_escape_string($conn,validateData($_POST['idno']));
	$check=mysqli_fetch_row(mysqli_query($conn,"select Status from voter_account where IdentityNo='$voterid'"))[0];

	if ($check==1) {
		?>
		<script type="text/javascript">
			$('#enable').attr('disabled',true);
			alert('You have already enabled this voter');
			window.location='voter.php';
		</script>
		<?php
	}else if ($check==0) {
		$update=mysqli_query($conn,"update voter_account set Status=1 where IdentityNo='$voterid'");
		echo "<script>alert('Success')</script>";
		echo "<script>location.href='voter.php'</script>";
		// exit();	
	}
	
}


function counts(){
	global $conn;
	$dis_total=mysqli_fetch_row(mysqli_query($conn,"select count(IdentityNo) from candidate"))[0];
	if (mysqli_num_rows($sql)>0) {
		
	}
}

if (isset($_POST['mca_submit'])) {
	mca_register();
}
else if (isset($_POST['mp_submit'])) {
	mp_register();
}
else if (isset($_POST['women_submit'])) {
	women_register();
}
else if (isset($_POST['senator_submit'])) {
	senator_register();
}
else if (isset($_POST['governor_submit'])) {
	governor_register();
}
else if (isset($_POST['president_submit'])) {
	presidentRegister();
}
else if (isset($_POST['add-position'])) {
	addposition();
}
else if(isset($_POST['add-election'])){
	addelection();
}
function addelection(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$name=mysqli_real_escape_string($conn, validateData($_POST['position']));
	$code=mysqli_real_escape_string($conn, validateData($_POST['code']));
	if (!empty($name)&& !empty($code)) {
		$sql=mysqli_query($conn, "insert into election(Election_Name, Election_Code) values('$name', '$code')");
		if ($sql) {
			echo "<script>alert('Election Added successfully')</script>";
			echo '<script>location.href="positions.php"</script>';
		}
		else{
			echo "<script>alert('Position Not Added')</script>";
			echo '<script>location.href="positions.php"</script>';
		}
	}
}
function addposition(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$name=mysqli_real_escape_string($conn, validateData($_POST['position']));
	$code=mysqli_real_escape_string($conn, validateData($_POST['code']));
	if (!empty($name)&& !empty($code)) {
		$sql=mysqli_query($conn, "insert into elective_seats(Seat_Name, Seat_Code) values('$name', '$code')");
		if ($sql) {
			echo "<script>alert('Position Added successfully')</script>";
			echo '<script>location.href="positions.php"</script>';
		}
		else{
			echo "<script>alert('Position Not Added')</script>";
			echo '<script>location.href="positions.php"</script>';
		}
	}
}
function mca_register(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$email = mysqli_real_escape_string($conn, validateData($_POST['email']));
	$phone = mysqli_real_escape_string($conn, validateData($_POST['phone']));
	$idno = mysqli_real_escape_string($conn, validateData($_POST['idno']));
	$county = mysqli_real_escape_string($conn, validateData($_POST['countyName']));
	$constituency = mysqli_real_escape_string($conn, validateData($_POST['constituencyName']));
	$ward = mysqli_real_escape_string($conn, validateData($_POST['wardName']));
	$party = mysqli_real_escape_string($conn, validateData($_POST['partyName']));
	$password = mysqli_real_escape_string($conn, validateData($_POST['password']));
	$cpassword = mysqli_real_escape_string($conn, validateData($_POST['cpassword']));
	$posId=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='Member of County Assembly'"))[0];

	$p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = '../assets/images/candidate/'.$p_image;

    $query=mysqli_query($conn,"select * from id_table where IdentityNo='$idno'");
    if (mysqli_num_rows($query)>0) {
    	while ($row=mysqli_fetch_assoc($query)) {
    		$name=$row['Name'];
    		$newIdNo=$row['IdentityNo'];
    		$gender=$row['Gender'];
    	}

    	$queryUser=mysqli_query($conn,"select * from candidate where IdentityNo='$idno'");
    	if (mysqli_num_rows($queryUser)>0) {
    		echo "<script>alert('Candidate already exists.')</script>";
    		echo "<script>location.href='add-candidate.php'</script>";
    	}else{
    		if ($password==$cpassword) {
		    	$insert=mysqli_query($conn,"insert into candidate(IdentityNo, Phone,Email,Position_id,Political_Party, Profile, reg_date, reg_time,Password) values('$newIdNo','$phone','$email','$posId','$party','$p_image',CURDATE(),CURTIME(),'$password')");

		    	$IdIinsert=mysqli_query($conn,"insert into mcas(IdentityNo, ward, Constituency, county) values('$newIdNo', '$ward','$constituency','$county')");

		    	if ($insert && $IdIinsert) {
					move_uploaded_file($p_image_tmp_name, $p_image_folder);
					echo "<script>alert('Registration successful')</script>";
					echo "<script>location.href='add-candidate.php'</script>";
				}
				else{
					echo "Registration unsuccessful";
				}
		    }

    	}

    	
    	
    }else{
    	echo "<script>alert('Identity Number not recognized. Try again')</script>";
    	echo "<script>location.href='signup.php'</script>";
    }

}

function mp_register(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$email = mysqli_real_escape_string($conn, validateData($_POST['email']));
	$phone = mysqli_real_escape_string($conn, validateData($_POST['phone']));
	$idno = mysqli_real_escape_string($conn, validateData($_POST['idno']));
	$county = mysqli_real_escape_string($conn, validateData($_POST['countyName']));
	$constituency = mysqli_real_escape_string($conn, validateData($_POST['constituencyName']));
	$party = mysqli_real_escape_string($conn, validateData($_POST['partyName']));
	$password = mysqli_real_escape_string($conn, validateData($_POST['password']));
	$cpassword = mysqli_real_escape_string($conn, validateData($_POST['cpassword']));
	$posId=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='Member of parliament'"))[0];

	$p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = '../assets/images/candidate/'.$p_image;

    $query=mysqli_query($conn,"select * from id_table where IdentityNo='$idno'");
    if (mysqli_num_rows($query)>0) {
    	while ($row=mysqli_fetch_assoc($query)) {
    		$name=$row['Name'];
    		$newIdNo=$row['IdentityNo'];
    		$gender=$row['Gender'];
    	}

    	$queryUser=mysqli_query($conn,"select * from candidate where IdentityNo='$idno'");
    	if (mysqli_num_rows($queryUser)>0) {
    		echo "<script>alert('Candidate already exists.')</script>";
    		echo "<script>location.href='add-candidate.php'</script>";
    	}else{
    		if ($password==$cpassword) {
		    	$insert=mysqli_query($conn,"insert into candidate(IdentityNo, Phone,Email,Position_id,Political_Party, Profile, reg_date, reg_time,Password) values('$newIdNo','$phone','$email','$posId','$party','$p_image',CURDATE(),CURTIME(),'$password')");

		    	$IdIinsert=mysqli_query($conn,"insert into mps(IdentityNo, Constituency_Code, County_Code) values('$newIdNo', '$constituency','$county')");

		    	if ($insert && $IdIinsert) {
					move_uploaded_file($p_image_tmp_name, $p_image_folder);
					echo "<script>alert('Registration successful')</script>";
					echo "<script>location.href='add-candidate.php'</script>";
				}
				else{
					echo "Registration unsuccessful";
				}
		    }

    	}

    	
    	
    }else{
    	echo "<script>alert('Identity Number not recognized. Try again')</script>";
    	echo "<script>location.href='signup.php'</script>";
    }

}

function women_register(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$email = mysqli_real_escape_string($conn, validateData($_POST['email']));
	$phone = mysqli_real_escape_string($conn, validateData($_POST['phone']));
	$idno = mysqli_real_escape_string($conn, validateData($_POST['idno']));
	$county = mysqli_real_escape_string($conn, validateData($_POST['countyName']));
	$party = mysqli_real_escape_string($conn, validateData($_POST['partyName']));
	$password = mysqli_real_escape_string($conn, validateData($_POST['password']));
	$cpassword = mysqli_real_escape_string($conn, validateData($_POST['cpassword']));
	$posId=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='Women representative'"))[0];

	$p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = '../assets/images/candidate/'.$p_image;

    $query=mysqli_query($conn,"select * from id_table where IdentityNo='$idno'");
    if (mysqli_num_rows($query)>0) {
    	while ($row=mysqli_fetch_assoc($query)) {
    		$name=$row['Name'];
    		$newIdNo=$row['IdentityNo'];
    		$gender=$row['Gender'];
    	}

    	$queryUser=mysqli_query($conn,"select * from candidate where IdentityNo='$idno'");
    	if (mysqli_num_rows($queryUser)>0) {
    		echo "<script>alert('Candidate already exists.')</script>";
    		echo "<script>location.href='add-candidate.php'</script>";
    	}else{
    		if ($password==$cpassword) {
		    	$insert=mysqli_query($conn,"insert into candidate(IdentityNo, Phone,Email,Position_id,Political_Party, Profile, reg_date, reg_time,Password) values('$newIdNo','$phone','$email','$posId','$party','$p_image',CURDATE(),CURTIME(),'$password')");

		    	$IdIinsert=mysqli_query($conn,"insert into women_rep(IdentityNo, County_Code) values('$newIdNo','$county')");

		    	if ($insert && $IdIinsert) {
					move_uploaded_file($p_image_tmp_name, $p_image_folder);
					echo "<script>alert('Registration successful')</script>";
					echo "<script>location.href='add-candidate.php'</script>";
				}
				else{
					echo "<script>alert('Registration unsuccessful')</script>";
				}
		    }

    	}

    	
    	
    }else{
    	echo "<script>alert('Identity Number not recognized. Try again')</script>";
    	echo "<script>location.href='signup.php'</script>";
    }

}

function senator_register(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$email = mysqli_real_escape_string($conn, validateData($_POST['email']));
	$phone = mysqli_real_escape_string($conn, validateData($_POST['phone']));
	$idno = mysqli_real_escape_string($conn, validateData($_POST['idno']));
	$county = mysqli_real_escape_string($conn, validateData($_POST['countyName']));
	$party = mysqli_real_escape_string($conn, validateData($_POST['partyName']));
	$password = mysqli_real_escape_string($conn, validateData($_POST['password']));
	$cpassword = mysqli_real_escape_string($conn, validateData($_POST['cpassword']));
	$posId=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='Senator'"))[0];

	$p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = '../assets/images/candidate/'.$p_image;

    $query=mysqli_query($conn,"select * from id_table where IdentityNo='$idno'");
    if (mysqli_num_rows($query)>0) {
    	while ($row=mysqli_fetch_assoc($query)) {
    		$name=$row['Name'];
    		$newIdNo=$row['IdentityNo'];
    		$gender=$row['Gender'];
    	}

    	$queryUser=mysqli_query($conn,"select * from candidate where IdentityNo='$idno'");
    	if (mysqli_num_rows($queryUser)>0) {
    		echo "<script>alert('Candidate already exists.')</script>";
    		echo "<script>location.href='add-candidate.php'</script>";
    	}else{
    		if ($password==$cpassword) {
		    	$insert=mysqli_query($conn,"insert into candidate(IdentityNo, Phone,Email,Position_id,Political_Party, Profile, reg_date, reg_time,Password) values('$newIdNo','$phone','$email','$posId','$party','$p_image',CURDATE(),CURTIME(),'$password')");

		    	$IdIinsert=mysqli_query($conn,"insert into senator(IdentityNo, County_Code) values('$newIdNo','$county')");

		    	if ($insert && $IdIinsert) {
					move_uploaded_file($p_image_tmp_name, $p_image_folder);
					echo "<script>alert('Registration successful')</script>";
					echo "<script>location.href='add-candidate.php'</script>";
				}else{
					echo "Registration unsuccessful";
				}
		    }

    	}

    	
    	
    }else{
    	echo "<script>alert('Identity Number not recognized. Try again')</script>";
    	echo "<script>location.href='signup.php'</script>";
    }

}

function governor_register(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$email = mysqli_real_escape_string($conn, validateData($_POST['email']));
	$phone = mysqli_real_escape_string($conn, validateData($_POST['phone']));
	$idno = mysqli_real_escape_string($conn, validateData($_POST['idno']));
	$county = mysqli_real_escape_string($conn, validateData($_POST['countyName']));
	$party = mysqli_real_escape_string($conn, validateData($_POST['partyName']));
	$password = mysqli_real_escape_string($conn, validateData($_POST['password']));
	$cpassword = mysqli_real_escape_string($conn, validateData($_POST['cpassword']));
	$posId=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='Governor'"))[0];

	$p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = '../assets/images/candidate/'.$p_image;

    $query=mysqli_query($conn,"select * from id_table where IdentityNo='$idno'");
    if (mysqli_num_rows($query)>0) {
    	while ($row=mysqli_fetch_assoc($query)) {
    		$name=$row['Name'];
    		$newIdNo=$row['IdentityNo'];
    		$gender=$row['Gender'];
    	}

    	$queryUser=mysqli_query($conn,"select * from candidate where IdentityNo='$idno'");
    	if (mysqli_num_rows($queryUser)>0) {
    		echo "<script>alert('Candidate already exists.')</script>";
    		echo "<script>location.href='add-candidate.php'</script>";
    	}else{
    		if ($password==$cpassword) {
		    	$insert=mysqli_query($conn,"insert into candidate(IdentityNo, Phone,Email,Position_id,Political_Party, Profile, reg_date, reg_time,Password) values('$newIdNo','$phone','$email','$posId','$party','$p_image',CURDATE(),CURTIME(),'$password')");

		    	$IdIinsert=mysqli_query($conn,"insert into governor(IdentityNo, County_Code) values('$newIdNo','$county')");

		    	if ($insert && $IdIinsert) {
					move_uploaded_file($p_image_tmp_name, $p_image_folder);
					echo "<script>alert('Registration successful')</script>";
					echo "<script>location.href='add-candidate.php'</script>";
				}
				else{
					echo "Registration unsuccessful";
				}
		    }

    	}

    	
    	
    }else{
    	echo "<script>alert('Identity Number not recognized. Try again')</script>";
    	echo "<script>location.href='signup.php'</script>";
    }

}
function presidentRegister(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$email = mysqli_real_escape_string($conn, validateData($_POST['email']));
	$phone = mysqli_real_escape_string($conn, validateData($_POST['phone']));
	$idno = mysqli_real_escape_string($conn, validateData($_POST['idno']));
	$party = mysqli_real_escape_string($conn, validateData($_POST['partyName']));
	$password = mysqli_real_escape_string($conn, validateData($_POST['password']));
	$cpassword = mysqli_real_escape_string($conn, validateData($_POST['cpassword']));
	$posId=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='President'"))[0];

	$p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = '../assets/images/candidate/'.$p_image;

    $query=mysqli_query($conn,"select * from id_table where IdentityNo='$idno'");
    if (mysqli_num_rows($query)>0) {
    	while ($row=mysqli_fetch_assoc($query)) {
    		$name=$row['Name'];
    		$newIdNo=$row['IdentityNo'];
    		$gender=$row['Gender'];
    	}

    	$queryUser=mysqli_query($conn,"select * from candidate where IdentityNo='$idno'");
    	if (mysqli_num_rows($queryUser)>0) {
    		echo "<script>alert('Candidate already exists.')</script>";
    		echo "<script>location.href='add-candidate.php'</script>";
    	}else{
    		if ($password==$cpassword) {
		    	$insert=mysqli_query($conn,"insert into candidate(IdentityNo, phone,Email,Position_id,Political_Party, Profile, reg_date,reg_time,Password) values('$newIdNo','$phone','$email','$posId','$party','$p_image',CURDATE(),CURTIME(),'$password')");


		    	if ($insert) {
					move_uploaded_file($p_image_tmp_name, $p_image_folder);
					echo "<script>alert('Registration successful')</script>";
					echo "<script>location.href='add-candidate.php'</script>";
				}
				else{
					echo "<script>alert('Registration unsuccessful')</script>";
					echo "<script>location.href='add-candidate.php'</script>";
				}
		    }

    	}

    	
    	
    }else{
    	echo "<script>alert('Identity Number not recognized. Try again')</script>";
    	echo "<script>location.href='signup.php'</script>";
    }

}

?>