<?php
@ include '../include/connection.php';
session_start();

if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];
	$title=mysqli_fetch_array(mysqli_query($conn, "select Election_Name from election"))[0];

	$query=mysqli_query($conn,"select * from voter_account, id_table where voter_account.IdentityNo='$idno' and id_table.IdentityNo=voter_account.IdentityNo");
	while ($row=mysqli_fetch_array($query)) {
		$voterID=$row['IdentityNo'];
		$name=$row['Name'];
		$phone=$row['phone'];
		$email=$row['Email'];
	}
}else{
	echo "<script>location.href='login.php'</script>";
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Voter Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
	<script type="text/javascript" src="../assets/javascript/time.js"></script>
</head>
<body>
	<div class="container">
		<?php include 'include/sidebar.php'   ?>
	<div class="main">

		<div class="index">
			<?php include 'include/header.php' ?>
			<div class="dash">
				<marquee><p style="font-style: bold; font-size: 24px"><?php echo $title; ?></p>	</marquee>			
			</div>
			
			<div class="btn">
				<a href="register.php">
					<div class="vote">
						<p>Register to vote</p>
					</div>
				</a>

				<a id="statu" href="#">
					<div class="vote">
						<p>My vote status</p>
					</div>
				</a>

				<a id="election" href="#">
					<div class="vote">
						<p>Current election</p>
					</div>
				</a>

				<a href="updateAccount.php">
					<div class="vote">
						<p>Update my account</p>
					</div>
				</a>
			</div>
			<div class="home">
				<?php include 'time.php' ?>	
			</div>	
			<div class="scrolmenu" id="presidentDiv">
				<h1>Presidency seat</h1>
				<div class="can-list">
					<?php				
						$sql=mysqli_query($conn,"select * from candidate,id_table where candidate.IdentityNo=id_table.IdentityNo and Position_Id=1");
						if (mysqli_num_rows($sql)>0) {
							foreach ($sql as $president) {							
								$presidentID=$president['IdentityNo'];
								$part=$president['Political_Party'];
								$candidate_name=$president['Name'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $president['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>
									
									<div id="vote">
										<form method="post" action="functions.php">
											<p><?php echo $president['Name'] ?></p>
											<p>President</p>
											<p><?php echo $party  ?></p>				
											<input type="checkbox" id="checkpres" name="presidentID" value="<?= $president['IdentityNo'] ?>"/>
											<input type="text" hidden name="voterID" value="<?= $voterID; ?>">
											<button id="submitPres" name="submitVotepres">Submit</button>
										</form>
										
									</div>
								</div>
								<?php
							}
						}else{
							echo "<h2>No data available</h2>";
						}
					  
					?>
				</div>
			</div>
			<div class="control" id="preControl" onclick="confirm_entry();">
				<button id="pre-back" style="margin-right: 75%">Back</button>
				<button id="pre-next">Next</button>
			</div>
			
			<div class="scrolmenu" id="governorDiv" style="display: none;">
				<h1>Gubernitorial seat</h1>
				<div class="can-list">
					<?php
					$sql=mysqli_query($conn,"SELECT * FROM candidate, governor, id_table, Location WHERE candidate.IdentityNo=id_table.IdentityNo AND Location.County=governor.County_Code and Location.IdentityNo='$voterID' and candidate.IdentityNo=governor.IdentityNo");
					
						if (mysqli_num_rows($sql)>0) {
							foreach ($sql as $governor) {							
								$governorID=$governor['IdentityNo'];
								$part=$governor['Political_Party'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand" id="voteDiv">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img class="tick" id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $governor['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img class="tick2" id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>			
								
									<div id="vote">
										<form method="post" action="functions.php">
											<p><?php echo $governor['Name'] ?></p>
											<p>Governor</p>
											<p><?php echo $party  ?></p>				
											<input type="checkbox" name="governorID" value="<?= $governor['IdentityNo'] ?>"/>
											<input type="text" hidden name="voterID" value="<?= $voterID; ?>">
											<button name="submitVoteGovn">Submit</button>
										</form>
										
									</div>
								</div>
								<?php
							}
						}
						else{
							echo "<h2>No data available</h2>";
						}

						?>
				</div>
			</div>
			<div class="control" id="govnControl" style="display: none;">
				<button id="govn-back" style="margin-right: 75%">Back</button>
				<button id="govn-next">Next</button>
			</div>


			<div class="scrolmenu" id="w_repDiv" style="display: none;">
				<h1>Women representative seat</h1>
				<div class="can-list">
					<?php
					$sql=mysqli_query($conn,"SELECT candidate.IdentityNo, id_table.Name, candidate.Profile,candidate.Political_Party, id_table.Name FROM candidate, id_table, Women_rep, Location WHERE candidate.IdentityNo=Women_rep.IdentityNo AND Location.County=Women_rep.County_Code and Location.IdentityNo='$voterID' and candidate.IdentityNo=id_table.IdentityNo");
					
						if (mysqli_num_rows($sql)>0) {
							while($wrep=mysqli_fetch_assoc($sql)) {						
								$womenID=$wrep['IdentityNo'];
								$part=$wrep['Political_Party'];
								$nam=$wrep['Name'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand" id="voteDiv">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img class="tick" id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $wrep['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img class="tick2" id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>
						
								
								<div id="vote">
										<form method="post" action="functions.php">
											<p><?php echo $wrep['Name'] ?></p>
											<p>Women Representative</p>
											<p><?php echo $party  ?></p>				
											<input type="checkbox" name="womanID" value="<?= $wrep['IdentityNo'] ?>"/>
											<input type="text" hidden name="voterID" value="<?= $voterID; ?>">
											<button name="submitVotewrep">Submit</button>
										</form>
										
									</div>
								</div>
								<?php
							}
						}
						else{
							echo "<h2>No data available</h2>";
						}

						?>
				</div>
			</div>
			<div class="control" id="womanControl" style="display: none;">
				<button id="w-rep-back" style="margin-right: 75%">Back</button>
				<button id="w-rep-next">Next</button>
			</div>

			<div class="scrolmenu" id="senatorDiv" style="display: none;">
				<h1>Senatorial seat</h1>
				<div class="can-list">
					<?php
					$sql=mysqli_query($conn,"SELECT candidate.IdentityNo,id_table.Name, candidate.Profile,candidate.Political_Party FROM candidate, id_table, senator, Location WHERE candidate.IdentityNo=senator.IdentityNo AND Location.County=senator.County_Code and Location.IdentityNo='$voterID' and candidate.IdentityNo=id_table.IdentityNo");
					
						if (mysqli_num_rows($sql)>0) {
							foreach ($sql as $senator) {								
								$idN=$senator['IdentityNo'];
								$part=$senator['Political_Party'];
								$nam=$senator['Name'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand" id="voteDiv">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img class="tick" id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $senator['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img class="tick2" id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>
						
								
									<div id="vote">
										<form method="post" action="functions.php">
											<p><?php echo $senator['Name'] ?></p>
											<p>Senator</p>
											<p><?php echo $party  ?></p>				
											<input type="checkbox" name="senatorID" value="<?= $senator['IdentityNo'] ?>"/>
											<input type="text" hidden name="voterID" value="<?= $voterID; ?>">
											<button name="submitVoteSen">Submit</button>
										</form>
										
									</div>
								</div>
								<?php
							}
						}
						else{
							echo "<h2>No data available</h2>";
						}

						?>
				</div>
			</div>
			<div class="control" id="senControl" style="display: none;">
				<button id="sen-back" style="margin-right: 75%">Back</button>
				<button id="sen-next">Next</button>
			</div>

			<div class="scrolmenu" id="mpDiv" style="display: none;">
				<h1>Member of Parliament seat</h1>
				<div class="can-list">
					<?php
					$sql=mysqli_query($conn,"SELECT candidate.IdentityNo,id_table.Name, candidate.Profile,candidate.Political_Party FROM candidate, id_table, mps, Location WHERE candidate.IdentityNo=mps.IdentityNo AND Location.County=mps.County_Code and Location.Constituency=mps.Constituency_Code  and Location.IdentityNo='$voterID' and candidate.IdentityNo=id_table.IdentityNo");
					
						if (mysqli_num_rows($sql)>0) {
							foreach ($sql as $mp) {							
								$idN=$mp['IdentityNo'];
								$part=$mp['Political_Party'];
								$nam=$mp['Name'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand" id="voteDiv">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img class="tick" id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $mp['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img class="tick2" id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>
						
								
								<div id="vote">
									<form method="post" action="functions.php">
										<p><?php echo $mp['Name'] ?></p>
										<p>Member of Parliament</p>
										<p><?php echo $party  ?></p>				
										<input type="checkbox" name="mpID" value="<?= $mp['IdentityNo'] ?>"/>
										<input type="text" hidden name="voterID" value="<?= $voterID; ?>">
										<button name="submitVoteMp">Submit</button>
									</form>
									
								</div>
								</div>
								<?php
							}
						}
						else{
							echo "<h2>No data available</h2>";
						}

						?>
				</div>
			</div>
			<div class="control" id="mpControl" style="display: none;">
				<button id="mp-back" style="margin-right: 75%">Back</button>
				<button id="mp-next">Next</button>
			</div>

			<div class="scrolmenu" id="mcaDiv" style="display: none;">
				<h1>Member of county assembly</h1>
				<div class="can-list">
					<?php
					$sql=mysqli_query($conn,"SELECT candidate.IdentityNo, id_table.Name, candidate.Profile,candidate.Political_Party FROM candidate,  id_table,mcas, Location WHERE candidate.IdentityNo=mcas.IdentityNo AND Location.County=mcas.county and Location.Constituency=mcas.Constituency and location.Ward=mcas.ward  and Location.IdentityNo='$voterID' and candidate.IdentityNo=id_table.IdentityNo");
					
						if (mysqli_num_rows($sql)>0) {
							foreach ($sql as $mca) {								
								$idN=$mca['IdentityNo'];
								$part=$mca['Political_Party'];
								$nam=$mca['Name'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand" id="voteDiv">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img class="tick" id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $mca['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img class="tick2" id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>					
								
									<div id="vote">
										<form method="post" action="functions.php">
											<p><?php echo $mca['Name'] ?></p>
											<p>Member of County Assembly</p>
											<p><?php echo $party  ?></p>				
											<input type="checkbox" name="mcaID" value="<?= $mca['IdentityNo'] ?>"/>
											<input type="text" hidden name="voterID" value="<?= $voterID; ?>">
											<button name="submitVoteMca">Submit</button>
										</form>
										
									</div>
								</div>
								<?php
							}
						}
						else{
							echo "<h2>No data available</h2>";
						}

						?>
				</div>
			</div>
			<div class="control" id="mcaControl" style="display: none;">
				<button id="mca-back" style="margin-right: 75%">Back</button>
				<button id="mca-next">Preview</button>
			</div>

			<div id="preview" style="display: none;">
				<?php include 'preview.php'; ?>
			</div>


			
		</div>
	</div>
</div>
<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#votehide img').hide();
		
		$('#pre-next').on('click',function(){
			$('#presidentDiv').hide();
			$('#governorDiv').show();
			$('#preControl').hide();
			$('#govnControl').show();			
		});
		$('#govn-next').on('click',function(){
			$('#governorDiv').hide();
			$('#w_repDiv').show();
			$('#govnControl').hide();
			$('#womanControl').show();			
		});
		$('#w-rep-next').on('click',function(){
			$('#w_repDiv').hide();
			$('#senatorDiv').show();
			$('#womanControl').hide();
			$('#senControl').show();			
		});
		$('#sen-next').on('click',function(){
			$('#senatorDiv').hide();
			$('#mpDiv').show();
			$('#senControl').hide();
			$('#mpControl').show();			
		});
		$('#mp-next').on('click',function(){
			$('#mpDiv').hide();
			$('#mcaDiv').show();
			$('#mpControl').hide();
			$('#mcaControl').show();		
		});
		$('#mca-next').on('click',function(){
			$('#mcaDiv').hide();
			$('#mcaControl').hide();
			$('#preview').show();
		});

		$('#submitPres').on('click',function(){
			$('#presidentDiv').hide();
			$('#governorDiv').show();
		});

		$('#presidentDiv').ready(function(){
			if (document.getElementById('checkpres').checked) {
				
			}
		});

	});
	
</script>


</body>
</html>