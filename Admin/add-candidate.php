<?php
session_start();
include '../include/connection.php';
if (isset($_SESSION['idno'])) {
		
}else{
	echo "<script>location.href='login.php'</script>";
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add party</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/jquery/jquery-3.6.3.min.js">
	<style type="text/css">
			.myDiv form{
				padding: 20px;
				background: #2c3e50;
				color: #fff;
				break-after: 5px;
				border-radius: 5px;
			}
			.myDiv form input,
			.myDiv form label,
			.myDiv form button,
			.myDiv span,
			.myDiv select,
			.myDiv a{
				border: 0;
				margin-bottom: 3px;
				display: block;
				width: 100%;
			}
			.myDiv a{
				text-decoration: none;
				text-align: center;
			}
			.myDiv form input,
			.myDiv select,
			.myDiv a{
				height: 25px;
				line-height: 30px;
				background: fff;
				color: #000;
				padding: 0 6px;
				box-sizing: border-box;
				border-radius: 5px;
			}
			.myDiv form .btn{
				height: 30px;
				line-height: 30px;
				background: #e67e22;
				color: #fff;
				text-transform: uppercase;
				font-weight: bold;
				margin-top: 1.5rem;
				cursor: pointer;
			}
			form .error{
				color: #ff0000;
			}
	</style>
</head>
<body>
	<div class="container">
		<?php include 'include/sidebar.php';  ?>
		<div class="main">
			<div class="index">
				<?php include 'include/header.php';  ?>
				<div class="candidate">
					<div class="pres" style="margin-left: 10px;">
						<a id="president" href="#"><h4 >President</h4> </a>
						<a id="governor" href="#"><h4 > Governor</h4> </a>
						<a href="#"><h4 id="senator"> Senator</h4> </a>
						<a href="#"><h4 id="w_rep"> Woman Representative</h4> </a>
						<a href="#"><h4 id="mp"> Member of parliament</h4> </a>
						<a href="#"><h4 id="mca"> Member of County Assembly</h4> </a>						
					</div>

					<div class="govt">
						<div class="myDiv" id="presidentDiv" style="display: block;">
							<p style="font-size: 24px; color: blue;">Add president</p>							
								<form action="functions.php" method="post" id="pre_registration" enctype="multipart/form-data">
									<div><span id="error"></span> </div>

									<label for="emaill">Email Name</label>
									<input type="email" name="email" id="pre_email" placeholder="abc@gmail.com">
									<!-- <span class="error" id="email-error">Your email is required</span> -->

									<label for="idno">Identity Number</label>
									<input type="number" name="idno" id="pre_idno" placeholder="123456789" required>
									<span class="error" id="idno-error">Your identity number is required</span>

									<label for="phoneNo">Phone Number</label>
									<input type="phone" name="phone" id="pre_phone" placeholder="+254" required>
									<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

									<label for="upload-img">Upload profile picture</label>
									<input type="file" name="p_image" id="pre_profile" accept="image/png, image/jpg, image/jpeg">
									<span class="error"></span>

									<?php
									$query=mysqli_query($conn,"select * from political_parties");
									?>
									<select id="mca_party" name="partyName" required>
										<option value="">Select Party</option>
										<?php
										if (mysqli_num_rows($query)>0) {
											while ($row=mysqli_fetch_assoc($query)) {
												echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
											}
										}else{
											echo '<option value="">No parties available</option>';
										}

										?>
									</select>

									<label for="password-insert">Password</label>
									<input type="password" name="password" id="pre_password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="pass-error">Your password is required</span> -->

									<label for="password-confirm">Confirm Password</label>
									<input type="password" name="cpassword" id="pre_cpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="cpass-error">Please confirm your password</span> -->

									<button name="president_submit" style="height: 30px; border-radius: 5px; margin-top: 10px;">Submit</button>
								</form>
							
							
						</div>

						<div class="myDiv" id="governorDiv" style="display: none;">
							<p style="font-size: 24px; color: blue;">Add Governor</p>							
								<form action="functions.php" method="post" id="gov_registration" enctype="multipart/form-data">
									<div><span id="error"></span> </div>

									<label for="emaill">Email Name</label>
									<input type="email" name="email" id="gov_email" placeholder="abc@gmail.com">
									<!-- <span class="error" id="email-error">Your email is required</span> -->

									<label for="idno">Identity Number</label>
									<input type="number" name="idno" id="gov_idno" placeholder="123456789" required>
									<span class="error" id="idno-error">Your identity number is required</span>

									<label for="phoneNo">Phone Number</label>
									<input type="phone" name="phone" id="gov_phone" placeholder="+254" required>
									<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

									<label for="upload-img">Upload profile picture</label>
									<input type="file" name="p_image" id="gov_profile" accept="image/png, image/jpg, image/jpeg">
									<span class="error"></span>

									<?php
									$query=mysqli_query($conn,"select * from counties");
									?>
									<label>County</label>
									<select id="gov_county" name="countyName" onchange="enableOthers(this)" required>
										<option value="">Select County</option>
										<?php
										if (mysqli_num_rows($query)>0) {
											while ($row=mysqli_fetch_assoc($query)) {
												echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
											}
										}else{
											echo '<option value="">No counties</option>';
										}

										?>
									</select>

									<?php
									$query=mysqli_query($conn,"select * from political_parties");
									?>
									<label>Select Party</label>
									<select id="mca_party" name="partyName" required>
										<option value="">Select Party</option>
										<?php
										if (mysqli_num_rows($query)>0) {
											while ($row=mysqli_fetch_assoc($query)) {
												echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
											}
										}else{
											echo '<option value="">No parties available</option>';
										}

										?>
									</select>

									<label for="password-insert">Password</label>
									<input type="password" name="password" id="gov_password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="pass-error">Your password is required</span> -->

									<label for="password-confirm">Confirm Password</label>
									<input type="password" name="cpassword" id="gov_cpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="cpass-error">Please confirm your password</span> -->

									<button name="governor_submit" style="height: 30px; border-radius: 5px; margin-top: 10px;">Submit</button>
								</form>
							
							
						</div>

						<div class="myDiv" id="senatorDiv" style="display: none;">
							<p style="font-size: 24px; color: blue;">Add Senator</p>							
								<form action="functions.php" method="post" id="sen_registration" enctype="multipart/form-data">
									<div><span id="error"></span> </div>

									<label for="idno">Email Address</label>
									<input type="email" name="email" id="sen_email" placeholder="abc@gmail.com" required>
									<span class="error" id="email-error">Your email is required</span>

									<label for="idno">Identity Number</label>
									<input type="number" name="idno" id="sen_idno" placeholder="123456789" required>
									<span class="error" id="idno-error">Your identity number is required</span>

									<label for="phoneNo">Phone Number</label>
									<input type="phone" name="phone" id="sen_phone" placeholder="+254" required>
									<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

									<label for="upload-img">Upload profile picture</label>
									<input type="file" name="p_image" id="sen_profile" accept="image/png, image/jpg, image/jpeg">
									<span class="error"></span>

									<?php
									$query=mysqli_query($conn,"select * from counties");
									?>
									<label>County</label>
									<select id="sen_county" name="countyName" onchange="enableOthers(this)" required>
										<option value="">Select County</option>
										<?php
										if (mysqli_num_rows($query)>0) {
											while ($row=mysqli_fetch_assoc($query)) {
												echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
											}
										}else{
											echo '<option value="">No counties</option>';
										}

										?>
									</select>

									<?php
									$query=mysqli_query($conn,"select * from political_parties");
									?>
									<label>Select Party</label>
									<select id="w_rep_party" name="partyName" required>
										<option value="">Select Party</option>
										<?php
										if (mysqli_num_rows($query)>0) {
											while ($row=mysqli_fetch_assoc($query)) {
												echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
											}
										}else{
											echo '<option value="">No parties available</option>';
										}

										?>
									</select>

									<label for="password-insert">Password</label>
									<input type="password" name="password" id="sen_password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="pass-error">Your password is required</span> -->

									<label for="password-confirm">Confirm Password</label>
									<input type="password" name="cpassword" id="sen_cpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="cpass-error">Please confirm your password</span> -->

									<button name="senator_submit" style="height: 30px; border-radius: 5px; margin-top: 10px;">Submit</button>
								</form>
							
							
						</div>

						<div class="myDiv" id="w_repDiv" style="display: none;">
							<p style="font-size: 24px; color: blue;">Add Women Representative</p>							
								<form action="functions.php" method="post" id="w_rep_registration" enctype="multipart/form-data">
									<div><span id="error"></span> </div>

									<label for="emaill">Email Name</label>
									<input type="email" name="email" id="w_repemail" placeholder="abc@gmail.com">
									<!-- <span class="error" id="email-error">Your email is required</span> -->

									<label for="idno">Identity Number</label>
									<input type="number" name="idno" id="w_repidno" placeholder="123456789" required>
									<span class="error" id="idno-error">Your identity number is required</span>

									<label for="phoneNo">Phone Number</label>
									<input type="phone" name="phone" id="w_repphone" placeholder="+254" required>
									<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

									<label for="upload-img">Upload profile picture</label>
									<input type="file" name="p_image" id="w_repprofile" accept="image/png, image/jpg, image/jpeg">
									<span class="error"></span>

									<?php
									$query=mysqli_query($conn,"select * from counties");
									?>
									<label>County</label>
									<select id="w_repcounty" name="countyName" onchange="enableOthers(this)" required>
										<option value="">Select County</option>
										<?php
										if (mysqli_num_rows($query)>0) {
											while ($row=mysqli_fetch_assoc($query)) {
												echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
											}
										}else{
											echo '<option value="">No counties</option>';
										}

										?>
									</select><br>

									<?php
									$query=mysqli_query($conn,"select * from political_parties");
									?>
									<label>Select Party</label>
									<select id="w_rep_party" name="partyName" required>
										<option value="">Select Party</option>
										<?php
										if (mysqli_num_rows($query)>0) {
											while ($row=mysqli_fetch_assoc($query)) {
												echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
											}
										}else{
											echo '<option value="">No parties available</option>';
										}

										?>
									</select>

									<label for="password-insert">Password</label>
									<input type="password" name="password" id="w_reppassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="pass-error">Your password is required</span> -->

									<label for="password-confirm">Confirm Password</label>
									<input type="password" name="cpassword" id="w_repcpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="cpass-error">Please confirm your password</span> -->

									<button name="women_submit" style="height: 30px; border-radius: 5px; margin-top: 10px;">Submit</button>
								</form>
							
							
						</div>

						<div class="myDiv" id="mpDiv" style="display: none;">
							<p style="font-size: 24px; color: blue;">Add Member of Parliament</p>							
								<form action="functions.php" method="post" id="mp_registration" enctype="multipart/form-data">
									<div><span id="error"></span> </div>

									<label for="emaill">Email Name</label>
									<input type="email" name="email" id="mp_email" placeholder="abc@gmail.com">
									<!-- <span class="error" id="email-error">Your email is required</span> -->

									<label for="idno">Identity Number</label>
									<input type="number" name="idno" id="mp_idno" placeholder="123456789" required>
									<span class="error" id="idno-error">Your identity number is required</span>

									<label for="phoneNo">Phone Number</label>
									<input type="phone" name="phone" id="mp_phone" placeholder="+254" required>
									<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

									<label for="upload-img">Upload profile picture</label>
									<input type="file" name="p_image" id="mp_profile" accept="image/png, image/jpg, image/jpeg">
									<span class="error"></span>

									<?php
									$query=mysqli_query($conn,"select * from counties");
									?>
									<label>County</label>
									<select id="mp_county" name="countyName" onchange="enableOthers(this)" required>
										<option value="">Select County</option>
										<?php
										if (mysqli_num_rows($query)>0) {
											while ($row=mysqli_fetch_assoc($query)) {
												echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
											}
										}else{
											echo '<option value="">No counties</option>';
										}

										?>
									</select><br>

									<label>Constituency</label>
									<select name="constituencyName" id="mp_constituency" required>
										<option value="">Select county first</option>
										
									</select><br>

									<?php
									$query=mysqli_query($conn,"select * from political_parties");
									?>
									<label>Select Party</label>
									<select id="mca_party" name="partyName" required>
										<option value="">Select Party</option>
										<?php
										if (mysqli_num_rows($query)>0) {
											while ($row=mysqli_fetch_assoc($query)) {
												echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
											}
										}else{
											echo '<option value="">No parties available</option>';
										}

										?>
									</select><br>

									<label for="password-insert">Password</label>
									<input type="password" name="password" id="mp_password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="pass-error">Your password is required</span> -->

									<label for="password-confirm">Confirm Password</label>
									<input type="password" name="cpassword" id="mp_cpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="cpass-error">Please confirm your password</span> -->

									<button name="mp_submit" style="height: 30px; border-radius: 5px; margin-top: 10px;">Submit</button>
								</form>
							
							
						</div>

						<div class="myDiv" id="mcaDiv" style="display: none;">
							<p style="font-size: 24px; color: blue;">Add Member of County Assembly</p>							
								<form action="functions.php" method="post" id="mca_registration" enctype="multipart/form-data">
									<div><span id="error"></span> </div>

									<label for="emaill">Email Name</label>
									<input type="email" name="email" id="mca_email" placeholder="abc@gmail.com">
									<!-- <span class="error" id="email-error">Your email is required</span> -->

									<label for="idno">Identity Number</label>
									<input type="number" name="idno" id="mca_idno" placeholder="123456789" required>
									<span class="error" id="idno-error">Your identity number is required</span>

									<label for="phoneNo">Phone Number</label>
									<input type="phone" name="phone" id="mca_phone" placeholder="+254" required>
									<!-- <span class="error" id="phone-error">Your phone number is required</span> -->

									<label for="upload-img">Upload profile picture</label>
									<input type="file" name="p_image" id="mca_profile" accept="image/png, image/jpg, image/jpeg">
									<span class="error"></span>

									<?php
									$query=mysqli_query($conn,"select * from counties");
									?>
									<label>County</label>
									<select id="mca_county" name="countyName" required>
										<option value="">Select County</option>
										<?php
										if (mysqli_num_rows($query)>0) {
											while ($row=mysqli_fetch_assoc($query)) {
												echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
											}
										}else{
											echo '<option value="">No counties</option>';
										}

										?>
									</select>

									<label>Constituency</label>
									<select name="constituencyName" id="mca_constituency" required>
										<option value="">Select county first</option>								
									</select>

									<label>Ward</label>
									<select name="wardName" id="mca_ward" required>
										<option value="">Select constituency first</option>								
									</select>

									<?php
									$query=mysqli_query($conn,"select * from political_parties");
									?>
									<label>Select Party</label>
									<select id="mca_party" name="partyName" required>
										<option value="">Select Party</option>
										<?php
										if (mysqli_num_rows($query)>0) {
											while ($row=mysqli_fetch_assoc($query)) {
												echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
											}
										}else{
											echo '<option value="">No parties available</option>';
										}

										?>
									</select>

									<label for="password-insert">Password</label>
									<input type="password" name="password" id="mca_password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="pass-error">Your password is required</span> -->

									<label for="password-confirm">Confirm Password</label>
									<input type="password" name="cpassword" id="mca_cpassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required>
									<!-- <span class="error" id="cpass-error">Please confirm your password</span> -->

									<button name="mca_submit" style="height: 30px; border-radius: 5px; margin-top: 10px;">Submit</button>
								</form>							
						</div>

					</div>
				</div>
				
			</div>
		</div>
	</div>
	<script type="text/javascript" src="include/add_candidate.js"></script>
	<script type="text/javascript" src="../assets/javascript/hide.js"></script>
	<script type="text/javascript">
		
		// function enableOthers(answer){
		// 	console.log(answer.value);
		// 	var myvalue=answer.value;
		// 	if (myvalue=='President') {
		// 		document.getElementById('countyDiv').style.display='none';
		// 		document.getElementById('constituencyDiv').style.display='none';
		// 		document.getElementById('wardDiv').style.display='none';
		// 		<?php
		// 		if (isset($_POST['submit'])) {
		// 			$pre_name=mysqli_real_escape_string($conn,$_POST['name']);
		// 			$sql=mysqli_query($conn,"insert into president(Name,County_Name) values('$pre_name')");
		// 		}
		// 		?>
		// 		// document.getElementById('county').classList.remove('county');
		// 	}else if(myvalue=='Governor'){
		// 		document.getElementById('countyDiv').style.display='block';
		// 		document.getElementById('constituencyDiv').style.display='none';
		// 		document.getElementById('wardDiv').style.display='none';
		// 		<?php
		// 		if (isset($_POST['submit'])) {
		// 			$govn_name=mysqli_real_escape_string($conn,$_POST['name']);
		// 			$county_name=mysqli_real_escape_string($conn,$_POST['countyName']);
		// 			$sql=mysqli_query($conn,"insert into governor(Name,County_Name) values('$govn_name','$county_name')");
		// 		}
		// 		?>
		// 	}
		// 	else if(answer.value=='Senator'){
		// 		document.getElementById('countyDiv').style.display='block';
		// 		document.getElementById('constituencyDiv').style.display='none';
		// 		document.getElementById('wardDiv').style.display='none';

		// 		<?php
		// 		if (isset($_POST['submit'])) {
		// 			$sen_name=mysqli_real_escape_string($conn,$_POST['name']);
		// 			$county_name=mysqli_real_escape_string($conn,$_POST['countyName']);
		// 			$sql=mysqli_query($conn,"insert into senator(Name,County_Name) values('$sen_name','$county_name')");
		// 		}
		// 		?>
			
		// 	}else if(answer.value=='Women representative'){
		// 		document.getElementById('countyDiv').style.display='block';
		// 		document.getElementById('constituencyDiv').style.display='none';
		// 		document.getElementById('wardDiv').style.display='none';

		// 		<?php
		// 		if (isset($_POST['submit'])) {
		// 			$wom_name=mysqli_real_escape_string($conn,$_POST['name']);
		// 			$county_name=mysqli_real_escape_string($conn,$_POST['countyName']);
		// 			$sql=mysqli_query($conn,"insert into w_rep(Name,County_Name) values('$wom_name','$county_name')");
		// 		}
		// 		?>
		// 	}
		// 	else if(answer.value=='Member of parliament'){
		// 		document.getElementById('countyDiv').style.display='block';
		// 		document.getElementById('constituencyDiv').style.display='block';
		// 		document.getElementById('wardDiv').style.display='none';

		// 		<?php
		// 		if (isset($_POST['submit'])) {
		// 			$mp_name=mysqli_real_escape_string($conn,$_POST['name']);
		// 			$county_name=mysqli_real_escape_string($conn,$_POST['countyName']);
		// 			$constituency_name=mysqli_real_escape_string($conn,$_POST['constituencyName']);
		// 			$sql=mysqli_query($conn,"insert into mp(Name,Constituency_Code,County_Code) values('$mp_name','$county_name','$constituency_name')");
		// 		}
		// 		?>
		// 	}
		// 	else if (answer.value=='Member of County Assembly') {
		// 		document.getElementById('countyDiv').style.display='block';
		// 		document.getElementById('constituencyDiv').style.display='block';
		// 		document.getElementById('wardDiv').style.display='block';
		// 		<?php
		// 		if (isset($_POST['submit'])) {
		// 			$name=mysqli_real_escape_string($conn,$_POST['name']);
		// 			$county_name=mysqli_real_escape_string($conn,$_POST['countyName']);
		// 			$constituency_name=mysqli_real_escape_string($conn,$_POST['constituencyName']);
		// 			$ward_name=mysqli_real_escape_string($conn,$_POST['wardName']);
		// 			$sql=mysqli_query($conn,"insert into m_c_a(Name,ward,Constituency, county) values('$name','$ward_name','$constituency_name','$county_name')");
		// 		}
		// 		?>				
		// 	}
		// }
	</script>

</body>
</html>