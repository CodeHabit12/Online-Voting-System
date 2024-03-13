<?php
@ include '../include/connection.php';
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

if (isset($_POST['voteLocation'])) {
	voterLocation();
}
else if (isset($_POST['submitVotepres'])) {
	votePresident();
}
else if (isset($_POST['submitVoteGovn'])) {
	voteGovernor();
}
else if (isset($_POST['submitVotewrep'])) {
	voteWoman();
}
else if (isset($_POST['submitVoteSen'])) {
	votesenator();
}
else if (isset($_POST['submitVoteMp'])) {
	votemp();
}
else if (isset($_POST['submitVoteMca'])) {
	votemca();
}

function voterLocation(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$idno=mysqli_real_escape_string($conn,validateData($_POST['idno']));
	$county=mysqli_real_escape_string($conn,validateData($_POST['countyName']));
	$constituency=mysqli_real_escape_string($conn,validateData($_POST['constituencyName']));
	$ward=mysqli_real_escape_string($conn,validateData($_POST['wardName']));

	$query=mysqli_query($conn,"select * from Location where IdentityNo='$idno'");
	if (mysqli_num_rows($query)>0) {
		echo "<script>alert('Your Identity Number is already registered. Please contact the system administrator')</script>";
		echo "<script>location.href='contact.php'</script>";
	}else{
		$insert=mysqli_query($conn,"insert into Location(IdentityNo,County,Constituency,Ward) values('$idno', '$county','$constituency','$ward')");

		if ($insert) {
			echo "<script>alert('Success. Now wait till all your details have being reviewed within 90 days')</script>";
			echo "<script>location.href='home.php'</script>";
		}

	}

}

function votePresident(){
	global $conn;
	function validateData($data){
			$resultData=htmlspecialchars(stripcslashes(trim($data)));
			return $resultData;
	}
	$pos_Id=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='President'"))[0];
	$preId=mysqli_real_escape_string($conn,$_POST['presidentID']);
	$preName=mysqli_fetch_array(mysqli_query($conn, "select Name from id_table where IdentityNo='$preId'"))[0];
	$voterID=mysqli_real_escape_string($conn,$_POST['voterID']);

	$check=mysqli_query($conn, "select IdentityNo from Votes where IdentityNo='$voterID'");
	if (mysqli_num_rows($check)>0) {
		?>
		<script type="text/javascript">
			alert('You already have voted. Click \'next\' to continue voting');
			// $('#vote').attr('disabled', 'disabled');
		</script>
		<?php
		echo "<script>location.href='home.php #governorDiv'</script>";
	}else{
		$query=mysqli_query($conn,"insert into Votes(IdentityNo) values('$voterID')");
		$vote=mysqli_query($conn, "update Votes set President='$preId'");
		if ($query && $vote) {
			echo "<script>alert('Success. You have voted for $preName;. Please continue the voting process')</script>";
			echo "<script>location.href='home.php'</script>";

		}else{
			echo "<script>echo('Error. Presidential vote was not submitted')</script>";
		}
	}
	
	
}
function voteGovernor(){
	global $conn;
	$pos_Id=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='Governor'"))[0];
	$govId=mysqli_real_escape_string($conn,$_POST['governorID']);
	$govName=mysqli_fetch_array(mysqli_query($conn, "select Name from id_table where IdentityNo='$govId'"))[0];
	$voterID=mysqli_real_escape_string($conn,$_POST['voterID']);

	$check=mysqli_query($conn, "select IdentityNo from Votes where IdentityNo='$voterID'");
	if (mysqli_num_rows($check)>0) {
		$check=mysqli_query($conn, "select * from Votes where IdentityNo='$voterID'");
			if (mysqli_num_rows($check)>0) {
				while ($row=mysqli_fetch_assoc($check)) {
					$pres=$row['President'];
					$govn=$row['Governor'];
				}
				if (empty($govn)) {
					$vote=mysqli_query($conn, "update Votes set Governor='$govId' where IdentityNo='$voterID'");
					if ($vote) {
						echo "<script>alert('Congatulation, you have voted for $govName;. Please continue the voting process.');</script>";
						echo "<script>location.href='home.php';</script>";
					}
				}else{
					echo "<script>alert('Already voted here. Please click the \'Next\' Button below to continue')</script>";
					echo "<script>location.href='home.php';</script>";
				}
			}
		
		
	}else{
		?>
		<script type="text/javascript">
			alert('Please make sure you submit your presidential result first. ');
			// $('#vote').attr('disabled', 'disabled');
		</script>
		<?php
		echo "<script>location.href='home.php'</script>";
	}
}

function voteWoman(){
	global $conn;
	$pos_Id=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='Women representative'"))[0];
	$womanId=mysqli_real_escape_string($conn,$_POST['womanID']);
	$womanName=mysqli_fetch_array(mysqli_query($conn, "select Name from id_table where IdentityNo='$womanId'"))[0];
	$voterID=mysqli_real_escape_string($conn,$_POST['voterID']);

	$check=mysqli_query($conn, "select IdentityNo from Votes where IdentityNo='$voterID'");
	if (mysqli_num_rows($check)>0) {
		$check=mysqli_query($conn, "select * from Votes where IdentityNo='$voterID'");
			if (mysqli_num_rows($check)>0) {
				while ($row=mysqli_fetch_assoc($check)) {
					$wom=$row['Women_Rep'];
				}
				if (empty($wom)) {
					$vote=mysqli_query($conn, "update Votes set Women_Rep='$womanId' where IdentityNo='$voterID'");
					if ($vote) {
						echo "<script>alert('Congatulation, you have voted for $womanName;. Please continue the voting process.');</script>";
						echo "<script>location.href='home.php';</script>";
					}
				}else{
					echo "<script>alert('Already voted here. Please click the \'Next\' Button below to continue')</script>";
					echo "<script>location.href='home.php';</script>";
				}
			}
		
		
	}else{
		?>
		<script type="text/javascript">
			alert('Please make sure you submit your presidential result first. ');
			// $('#vote').attr('disabled', 'disabled');
		</script>
		<?php
		echo "<script>location.href='home.php'</script>";
	}
	
}

function votesenator(){
	global $conn;
	global $conn;
	$pos_Id=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='Senator'"))[0];
	$senId=mysqli_real_escape_string($conn,$_POST['senatorID']);
	$senName=mysqli_fetch_array(mysqli_query($conn, "select Name from id_table where IdentityNo='$senId'"))[0];
	$voterID=mysqli_real_escape_string($conn,$_POST['voterID']);

	$check=mysqli_query($conn, "select IdentityNo from Votes where IdentityNo='$voterID'");
	if (mysqli_num_rows($check)>0) {
		$check=mysqli_query($conn, "select * from Votes where IdentityNo='$voterID'");
			if (mysqli_num_rows($check)>0) {
				while ($row=mysqli_fetch_assoc($check)) {
					$wom=$row['Senator'];
				}
				if (empty($wom)) {
					$vote=mysqli_query($conn, "update Votes set Senator='$senId' where IdentityNo='$voterID'");
					if ($vote) {
						echo "<script>alert('Congatulation, you have voted for $senName;. Please continue the voting process.');</script>";
						echo "<script>location.href='home.php';</script>";
					}
				}else{
					echo "<script>alert('Already voted here. Please click the \'Next\' Button below to continue')</script>";
					echo "<script>location.href='home.php';</script>";
				}
			}
		
		
	}else{
		?>
		<script type="text/javascript">
			alert('Please make sure you submit your presidential result first. ');
			// $('#vote').attr('disabled', 'disabled');
		</script>
		<?php
		echo "<script>location.href='home.php'</script>";
	}
}
function votemp(){
	global $conn;
	$pos_Id=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='Member of parliament'"))[0];
	$mpId=mysqli_real_escape_string($conn,$_POST['mpID']);
	$mpName=mysqli_fetch_array(mysqli_query($conn, "select Name from id_table where IdentityNo='$mpId'"))[0];
	$voterID=mysqli_real_escape_string($conn,$_POST['voterID']);

	$check=mysqli_query($conn, "select IdentityNo from Votes where IdentityNo='$voterID'");
	if (mysqli_num_rows($check)>0) {
		$check=mysqli_query($conn, "select * from Votes where IdentityNo='$voterID'");
			if (mysqli_num_rows($check)>0) {
				while ($row=mysqli_fetch_assoc($check)) {
					$wom=$row['MP'];
				}
				if (empty($wom)) {
					$vote=mysqli_query($conn, "update Votes set MP='$mpId' where IdentityNo='$voterID'");
					if ($vote) {
						echo "<script>alert('Congatulation, you have voted for $mpName;. Please continue the voting process.');</script>";
						echo "<script>location.href='home.php';</script>";
					}
				}else{
					echo "<script>alert('Already voted here. Please click the \'Next\' Button below to continue')</script>";
					echo "<script>location.href='home.php';</script>";
				}
			}
		
		
	}else{
		?>
		<script type="text/javascript">
			alert('Please make sure you submit your presidential result first. ');
			// $('#vote').attr('disabled', 'disabled');
		</script>
		<?php
		echo "<script>location.href='home.php'</script>";
	}
}
function votemca(){
	global $conn;
	$pos_Id=mysqli_fetch_array(mysqli_query($conn, "select Id from Positions where Seat_Name='Member of County Assembly'"))[0];
	$mcaId=mysqli_real_escape_string($conn,$_POST['mcaID']);
	$mcaName=mysqli_fetch_array(mysqli_query($conn, "select Name from candidate where IdentityNo='$mcaId'"))[0];
	$voterID=mysqli_real_escape_string($conn,$_POST['voterID']);

	$check=mysqli_query($conn, "select IdentityNo from Votes where IdentityNo='$voterID'");
	if (mysqli_num_rows($check)>0) {
		$check=mysqli_query($conn, "select * from Votes where IdentityNo='$voterID'");
			if (mysqli_num_rows($check)>0) {
				while ($row=mysqli_fetch_assoc($check)) {
					$wom=$row['MCA'];
				}
				if (empty($wom)) {
					$vote=mysqli_query($conn, "update Votes set MCA='$mcaId' where IdentityNo='$voterID'");
					if ($vote) {
						echo "<script>alert('Congatulation, you have voted for $mcaName;. Please click on \'Preview\' to see a summary of the candidates you voted for. Thank you for your vote.');</script>";
						echo "<script>location.href='home.php';</script>";
					}
				}else{
					echo "<script>alert('Already voted here. Please click on \'Preview\' to see a summary of the candidates you voted for. Thank you for your vote.')</script>";
					echo "<script>location.href='home.php';</script>";
				}
			}
		
		
	}else{
		?>
		<script type="text/javascript">
			alert('Please make sure you submit your presidential result first. ');
			// $('#vote').attr('disabled', 'disabled');
		</script>
		<?php
		echo "<script>location.href='home.php'</script>";
	}
}










?>