<?php
@ include '../include/connection.php';
session_start();
if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];
	$title=mysqli_fetch_array(mysqli_query($conn, "select Election_Name from election"))[0];

	$query=mysqli_query($conn,"select * from candidate, id_table where candidate.IdentityNo='$idno' and candidate.IdentityNo=id_table.IdentityNo");
	while ($row=mysqli_fetch_array($query)) {
		$name=$row['Name'];
		$phone=$row['Phone'];
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
	<title>Candidate Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
	<div class="container">
		<?php include 'sidebar.php'   ?>
	<div class="main">
		<div class="index">
			<?php  include 'topbar.php';  ?>
			<div class="dash">
				<marquee><p style="font-style: bold; font-size: 24px"><?php echo $title; ?></p>	</marquee>			
			</div>
			
			<div class="btn">


				<a href="index.php">
					<div class="vote">
						<p>Current election</p>
					</div>
				</a>

				<a href="edit-cand.php">
					<div class="vote">
						<p>Update my account</p>
					</div>
				</a>

				<a href="contact.php">
					<div class="vote">
						<p>Claims</p>
					</div>
				</a>

				<a href="results.php">
					<div class="vote">
						<p>Results</p>
					</div>
				</a>
			</div>	
			<div class="scrolmenu">
				<h1>Presidency seat</h1>
				<div class="can-list">
					<?php					
						$sql=mysqli_query($conn,"select * from candidate, id_table where candidate.IdentityNo=id_table.IdentityNo and Position_Id=1");
						if (mysqli_num_rows($sql)>0) {
							foreach ($sql as $row) {
								
								$presidentID=$row['IdentityNo'];
								$part=$row['Political_Party'];
								$nam=$row['Name'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $row['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>
									
									<div id="vote">
										<form method="post" action="functions.php">
											<p style="font-style: bold italic;"><?php echo $row['Name'] ?></p>
											<p style="font-size: 24px">President</p>
											<p><?php echo $party  ?></p> 
											<?php 
											$presCount=mysqli_fetch_row(mysqli_query($conn,"select count(President) from votes where President='$presidentID'"))[0]; 
											?>
											<h2 style="text-align: center;"><?php echo $presCount ?> Vote(s)</h2>
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
			<div class="scrolmenu">
				<h1>Gubernitorial seat</h1>
				<div class="can-list">
					<?php
					$sql=mysqli_query($conn,"select * from governor,candidate, id_table where candidate.IdentityNo=id_table.IdentityNo and governor.IdentityNo=candidate.IdentityNo and governor.IdentityNo=id_table.IdentityNo");
					
						if (mysqli_num_rows($sql)>0) {
							foreach ($sql as $row) {
								
								$governorID=$row['IdentityNo'];
								$part=$row['Political_Party'];
								$nam=$row['Name'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand" id="voteDiv">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img class="tick" id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $row['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img class="tick2" id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>
						
								
									<div id="vote">
										<form method="post" action="functions.php">
											<p style="font-style: bold italic;"><?php echo $row['Name'] ?></p>
											<p style="font-size: 24px">Governor</p>
											<p><?php echo $party  ?></p> 
											<?php 
											$presCount=mysqli_fetch_row(mysqli_query($conn,"select count(Governor) from Votes where Governor='$governorID'"))[0]; 
											?>
											<h2 style="text-align: center;"><?php echo $presCount ?></h2>
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

			<div class="scrolmenu">
				<h1>Women representative seat</h1>
				<div class="can-list">
					<?php
					$sql=mysqli_query($conn,"select * from candidate, Women_Rep, id_table where candidate.IdentityNo=Women_Rep.IdentityNo and candidate.IdentityNo=id_table.IdentityNo and Women_Rep.IdentityNo=id_table.IdentityNo");
					
						if (mysqli_num_rows($sql)>0) {
							while ($row=mysqli_fetch_assoc($sql)) {
								$womenID=$row['IdentityNo'];
								$part=$row['Political_Party'];
								$nam=$row['Name'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand" id="voteDiv">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img class="tick" id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $row['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img class="tick2" id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>
						
								
									<div id="vote">
										<form method="post" action="functions.php">
											<p style="font-style: bold italic;"><?php echo $row['Name'] ?></p>
											<p style="font-size: 24px">Women Reps</p>
											<p><?php echo $party  ?></p> 
											<?php 
											$presCount=mysqli_fetch_row(mysqli_query($conn,"select count(Women_Rep) from votes where Women_Rep='$womenID'"))[0]; 
											?>
											<h2 style="text-align: center;"><?php echo $presCount ?></h2>
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

			<div class="scrolmenu">
				<h1>Senatorial seat</h1>
				<div class="can-list">
					<?php
					$sql=mysqli_query($conn,"select * from candidate,senator, id_table where candidate.IdentityNo=senator.IdentityNo and candidate.IdentityNo=id_table.IdentityNo and senator.IdentityNo=id_table.IdentityNo");
					
						if (mysqli_num_rows($sql)>0) {
							while ($row=mysqli_fetch_assoc($sql)) {
								$senatorID=$row['IdentityNo'];
								$part=$row['Political_Party'];
								$nam=$row['Name'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand" id="voteDiv">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img class="tick" id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $row['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img class="tick2" id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>
						
								
									<div id="vote">
										<form method="post" action="functions.php">
											<p style="font-style: bold italic;"><?php echo $row['Name'] ?></p>
											<p style="font-size: 24px">Senator</p>
											<p><?php echo $party  ?></p> 
											<?php 
											$presCount=mysqli_fetch_row(mysqli_query($conn,"select count(Senator) from votes where Senator='$senatorID'"))[0]; 
											?>
											<h2 style="text-align: center;"><?php echo $presCount ?></h2>
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

			<div class="scrolmenu">
				<h1>Member of Parliament seat</h1>
				<div class="can-list">
					<?php
					$sql=mysqli_query($conn,"select * from candidate,mps, id_table where candidate.IdentityNo=mps.IdentityNo and candidate.IdentityNo=id_table.IdentityNo and mps.IdentityNo=id_table.IdentityNo");
					
						if (mysqli_num_rows($sql)>0) {
							while ($row=mysqli_fetch_assoc($sql)) {
								$mpID=$row['IdentityNo'];
								$part=$row['Political_Party'];
								$nam=$row['Name'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand" id="voteDiv">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img class="tick" id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $row['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img class="tick2" id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>
						
								
									<div id="vote">
										<form method="post" action="functions.php">
											<p style="font-style: bold italic;"><?php echo $row['Name'] ?></p>
											<p style="font-size: 24px">MP</p>
											<p><?php echo $party  ?></p> 
											<?php 
											$presCount=mysqli_fetch_row(mysqli_query($conn,"select count(MP) from votes where MP='$mpID'"))[0]; 
											?>
											<h2 style="text-align: center;"><?php echo $presCount ?></h2>
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

			<div class="scrolmenu">
				<h1>Member of county assembly</h1>
				<div class="can-list">
					<?php
					$sql=mysqli_query($conn,"SELECT * FROM candidate, mcas, id_table where candidate.IdentityNo=mcas.IdentityNo and candidate.IdentityNo=id_table.IdentityNo and mcas.IdentityNo=id_table.IdentityNo");
					
						if (mysqli_num_rows($sql)>0) {
							while ($row=mysqli_fetch_assoc($sql)) {
								$mcaID=$row['IdentityNo'];
								$part=$row['Political_Party'];
								$nam=$row['Name'];
								$party=mysqli_fetch_row(mysqli_query($conn,"select Name from political_parties where Code='$part'"))[0];
								?>
								<div class="cand" id="voteDiv">
									<div class="alignImg">
										<div class="votehide" id="votehide">
											<img class="tick" id="tick" src="../assets/icons/tick.png">			
										</div>
										<div class="prof">
											<img class="prof" src="../assets/images/candidate/<?php echo $row['Profile'] ;  ?>">
										</div>
										<div class="votehide" id="votehide">			
											<img class="tick2" id="tick" src="../assets/icons/icons8-done.gif">
										</div>
									</div>
						
								
									<div id="vote">
										<form method="post" action="functions.php">
											<p style="font-style: bold italic;"><?php echo $row['Name'] ?></p>
											<input style="display: none;" type="text" name="idnopres" value="<?php $idN ?>">
											<p style="font-size: 24px">MCA'S</p>
											<p><?php echo $party  ?></p> 
											<?php 
											$presCount=mysqli_fetch_row(mysqli_query($conn,"select count(MCA) from votes where MCA='$mcaID'"))[0]; 
											?>
											<h2 style="text-align: center;"><?php echo $presCount ?></h2>
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

			

			
		</div>
	</div>
</div>
<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		// $('.votehide img').css("display","none");
		$('.votehide img').hide();
	});
</script>


</body>
</html>