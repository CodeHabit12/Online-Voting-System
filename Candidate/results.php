<?php
include '../include/connection.php';

session_start();
if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];
	$title=mysqli_fetch_array(mysqli_query($conn, "select Election_Name from election"))[0];
	$voterID=$idno;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Election Results</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<script src="../assets/chart.js/Chart.min.js"></script>
	<script src="../assets/jquery/jquery-3.6.3.min.js"></script>
	<script src="../assets/chart.js/Chart.HorizontalBar.js"></script>
	<script src="../assets/jquery/dist/jquery.min.js"></script>
	<style>
    .bar {
    	margin-top: 10px;
      height: 25px;
      background-color: blue;
      margin-bottom: 5px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
	<div class="container">
		<?php  include 'sidebar.php' ?>
		<div class="main">
			<div class="index">
				<?php  include 'topbar.php' ?>
				<div class="dash">
				<marquee><p style="font-style: bold; font-size: 24px"><?php echo $title; ?></p>	</marquee>			
			</div>
				<div class="candAlign">
					<div class="dashb">
						<label>Election data centre- Results</label>
						<!-- <input type="search" name="search" placeholder="Search">					 -->
					</div>

					<div class="box" id="presidentClick" >
						<p>Presidential Results</p>
						<!-- <h3><?php echo $candTotal; ?> candidate(s)</h3> -->
					</div>
					
					<div class="box" id="governorClick" >
						<p>Gubernatorial Results</p>
						<!-- <h3><?php echo $president; ?> candidate(s)</h3> -->
					</div>

					<div id="senatorClick" class="box">
						<p>Senator Results</p>
						<!-- <h3><?php echo $governor; ?></h3> -->
					</div>

					<div id="womenClick" class="box">
						<p>Women Representative</p>
						<!-- <h3><?php echo $senator; ?></h3>	 -->
					</div>				
				
					<div id="mpClick" class="box">
						<p>Member of Parliament</p>
						<!-- <h3><?php echo $w_rep; ?></h3> -->
					</div>

					<div id="mcaClick" class="box">
						<p>Member of County Assembly</p>
						<!-- <h3><?php echo $w_rep; ?></h3> -->
					</div>					
					
				</div>

				<div class="scrolmenu" id="presidentDiv">
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
					<center>
						<div style="width: 90%; height: 100px; border: 1px solid; border-radius: 5px; padding: 10px;" id="results">
							<h2>Presidential Results</h2>
							<?php

							$total=mysqli_fetch_row(mysqli_query($conn, "select count(President) from votes"))[0];
							
							$sql = "SELECT Name, count(votes.President) as voteCount FROM votes, id_table where votes.President=id_table.IdentityNo";
							$result = mysqli_query($conn, $sql);

							// Create an array to store the student names and scores
							$students = array();
							while ($row = mysqli_fetch_assoc($result)) {
							  $students[] = array("Name" => $row["Name"], "voteCount" => $row["voteCount"]);
							}

							foreach ($students as $student) {
							    $voteCount = $student["voteCount"];
							    $name = $student["Name"];
							    // $percent = $voteCount / $total;
							    $percent= $voteCount/$total*100;
							    

							    // Display the student name and score
							    echo "<p>$name: $voteCount Vote(s)</p>";

							    // Display the horizontal bar graph
							    echo "<div class='bar' style='width: ${percent}%;'><p>$percent%</p></div>";
							  }
							?>
						</div>
					</center>
					
				</div>
				<div class="scrolmenu" style="display: none;" id="governorDiv">
					<h1>Gubernitorial seat</h1>
					<div class="can-list">
						<?php
						$sql=mysqli_query($conn,"SELECT Name, id_table.IdentityNo, Profile, Political_Party FROM candidate, governor, id_table, Location WHERE candidate.IdentityNo=id_table.IdentityNo AND Location.County=governor.County_Code and Location.IdentityNo='$voterID' and candidate.IdentityNo=governor.IdentityNo");
						
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
												<h2 style="text-align: center;"><?php echo $presCount ?> Votes</h2>
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
					<center>
						<div style="width: 90%; height: 100px; border: 1px solid; border-radius: 5px; padding: 10px;" id="results">
							<h2>Gubernatorial Results</h2>
							<?php

							$total=mysqli_fetch_row(mysqli_query($conn, "select count(Governor) from votes"))[0];
							
							$sql = "SELECT Name, count(Governor) as voteCount from votes, location, id_table, governor where location.IdentityNo='$voterID' and location.County=governor.County_Code and governor.IdentityNo=id_table.IdentityNo and votes.Governor=Governor.IdentityNo";
							$result = mysqli_query($conn, $sql);

							// Create an array to store the student names and scores
							$students = array();
							while ($row = mysqli_fetch_assoc($result)) {
							  $students[] = array("Name" => $row["Name"], "voteCount" => $row["voteCount"]);
							}

							foreach ($students as $student) {
							    $voteCount = $student["voteCount"];
							    $name = $student["Name"];
							    // $percent = $voteCount / $total;
							    $percent= $voteCount/$total*100;
							    

							    // Display the student name and score
							    echo "<p>$name: $voteCount Vote(s)</p>";

							    // Display the horizontal bar graph
							    echo "<div class='bar' style='width: ${percent}%;'><p>$percent%</p></div>";
							  }
							?>
						</div>
					</center>
				</div>

				<div class="scrolmenu" style="display: none;" id="womenDiv">
					<h1>Women representative seat</h1>
					<div class="can-list">
						<?php
						$sql=mysqli_query($conn,"SELECT Name, id_table.IdentityNo, Profile, Political_Party from candidate, Women_Rep, id_table where candidate.IdentityNo=Women_Rep.IdentityNo and candidate.IdentityNo=id_table.IdentityNo and Women_Rep.IdentityNo=id_table.IdentityNo");
						
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
					<center>
						<div style="width: 90%; height: 100px; border: 1px solid; border-radius: 5px; padding: 10px;" id="results">
							<h2>Women Representative</h2>
							<?php

							$total=mysqli_fetch_row(mysqli_query($conn, "select count(Women_Rep) from votes"))[0];
							
							$sql = "SELECT Name, count(Women_Rep) as voteCount from votes, location, id_table, Women_Rep where location.IdentityNo='$voterID' and location.County=Women_Rep.County_Code and Women_Rep.IdentityNo=id_table.IdentityNo and votes.Women_Rep=Women_Rep.IdentityNo";
							$result = mysqli_query($conn, $sql);

							// Create an array to store the student names and scores
							$students = array();
							while ($row = mysqli_fetch_assoc($result)) {
							  $students[] = array("Name" => $row["Name"], "voteCount" => $row["voteCount"]);
							}

							foreach ($students as $student) {
							    $voteCount = $student["voteCount"];
							    $name = $student["Name"];
							    // $percent = $voteCount / $total;
							    $percent= $voteCount/$total*100;
							    

							    // Display the student name and score
							    echo "<p>$name: $voteCount Vote(s)</p>";

							    // Display the horizontal bar graph
							    echo "<div class='bar' style='width: ${percent}%;'><p>$percent%</p></div>";
							  }
							?>
						</div>
					</center>
				</div>

				<div class="scrolmenu" style="display: none;" id="senatorDiv">
					<h1>Senatorial seat</h1>
					<div class="can-list">
						<?php
						$sql=mysqli_query($conn,"SELECT Name, id_table.IdentityNo, Profile, Political_Party from candidate,senator, id_table where candidate.IdentityNo=senator.IdentityNo and candidate.IdentityNo=id_table.IdentityNo and senator.IdentityNo=id_table.IdentityNo");
						
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
					<center>
						<div style="width: 90%; height: 100px; border: 1px solid; border-radius: 5px; padding: 10px;" id="results">
							<h2>Senator</h2>
							<?php

							$total=mysqli_fetch_row(mysqli_query($conn, "select count(Senator) from votes"))[0];
							
							$sql = "SELECT Name, count(Senator) as voteCount from votes, location, id_table, Senator where location.IdentityNo='$voterID' and location.County=Senator.County_Code and Senator.IdentityNo=id_table.IdentityNo and votes.Senator=Senator.IdentityNo";
							$result = mysqli_query($conn, $sql);

							// Create an array to store the student names and scores
							$students = array();
							while ($row = mysqli_fetch_assoc($result)) {
							  $students[] = array("Name" => $row["Name"], "voteCount" => $row["voteCount"]);
							}

							foreach ($students as $student) {
							    $voteCount = $student["voteCount"];
							    $name = $student["Name"];
							    // $percent = $voteCount / $total;
							    $percent= $voteCount/$total*100;
							    

							    // Display the student name and score
							    echo "<p>$name: $voteCount Vote(s)</p>";

							    // Display the horizontal bar graph
							    echo "<div class='bar' style='width: ${percent}%;'><p>$percent%</p></div>";
							  }
							?>
						</div>
					</center>
				</div>

				<div class="scrolmenu" style="display: none;" id="mpDiv">
					<h1>Member of Parliament seat</h1>
					<div class="can-list">
						<?php
						$sql=mysqli_query($conn,"select Name, id_table.IdentityNo, Profile, Political_Party from candidate,mps, id_table where candidate.IdentityNo=mps.IdentityNo and candidate.IdentityNo=id_table.IdentityNo and mps.IdentityNo=id_table.IdentityNo");
						
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
					<center>
						<div style="width: 90%; height: 100px; border: 1px solid; border-radius: 5px; padding: 10px;" id="results">
							<h2>Member of Parliament</h2>
							<?php

							$total=mysqli_fetch_row(mysqli_query($conn, "select count(MP) from votes"))[0];
							
							$sql = "SELECT Name, count(MP) as voteCount from votes, location, id_table, mps where location.IdentityNo='$voterID' and location.County=mps.County_Code and location.Constituency=mps.Constituency_Code and mps.IdentityNo=id_table.IdentityNo and votes.MP=mps.IdentityNo";
							$result = mysqli_query($conn, $sql);

							// Create an array to store the student names and scores
							$students = array();
							while ($row = mysqli_fetch_assoc($result)) {
							  $students[] = array("Name" => $row["Name"], "voteCount" => $row["voteCount"]);
							}

							foreach ($students as $student) {
							    $voteCount = $student["voteCount"];
							    $name = $student["Name"];
							    // $percent = $voteCount / $total;
							    $percent= $voteCount/$total*100;
							    

							    // Display the student name and score
							    echo "<p>$name: $voteCount Vote(s)</p>";

							    // Display the horizontal bar graph
							    echo "<div class='bar' style='width: ${percent}%;'><p>$percent%</p></div>";
							  }
							?>
						</div>
					</center>
				</div>

				<div class="scrolmenu" style="display: none;" id="mcaDiv">
					<h1>Member of county assembly</h1>
					<div class="can-list">
						<?php
						$sql=mysqli_query($conn,"SELECT Name, id_table.IdentityNo, Profile, Political_Party FROM candidate, mcas, id_table where candidate.IdentityNo=mcas.IdentityNo and candidate.IdentityNo=id_table.IdentityNo and mcas.IdentityNo=id_table.IdentityNo");
						
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
					<center>
						<div style="width: 90%; height: 100px; border: 1px solid; border-radius: 5px; padding: 10px;" id="results">
							<h2>Member of County Assembly</h2>
							<?php

							$total=mysqli_fetch_row(mysqli_query($conn, "select count(MCA) from votes"))[0];
							
							$sql = "SELECT Name, count(MCA) as voteCount from votes, location, id_table, mcas where location.IdentityNo='$voterID' and location.County=mcas.county and location.Constituency=mcas.Constituency and location.Ward=mcas.ward and mcas.IdentityNo=id_table.IdentityNo and votes.MCA=mcas.IdentityNo";
							$result = mysqli_query($conn, $sql);

							// Create an array to store the student names and scores
							$students = array();
							while ($row = mysqli_fetch_assoc($result)) {
							  $students[] = array("Name" => $row["Name"], "voteCount" => $row["voteCount"]);
							}

							foreach ($students as $student) {
							    $voteCount = $student["voteCount"];
							    $name = $student["Name"];
							    // $percent = $voteCount / $total;
							    $percent= $voteCount/$total*100;
							    

							    // Display the student name and score
							    echo "<p>$name: $voteCount Vote(s)</p>";

							    // Display the horizontal bar graph
							    echo "<div class='bar' style='width: ${percent}%;'><p>$percent%</p></div>";
							  }
							?>
						</div>
					</center>
				</div>						
			</div>
			
		</div>
		
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#presidentClick').on('click', function(){
				$('#presidentDiv').css('display', 'block');
				$('#governorDiv').css('display', 'none');
				$('#senatorDiv').css('display', 'none');
				$('#womenDiv').css('display', 'none');
				$('#mpDiv').css('display', 'none');
				$('#mcaDiv').css('display', 'none');
			})

			$('#governorClick').on('click', function(){
				$('#presidentDiv').css('display', 'none');
				$('#governorDiv').css('display', 'block');
				$('#senatorDiv').css('display', 'none');
				$('#womenDiv').css('display', 'none');
				$('#mpDiv').css('display', 'none');
				$('#mcaDiv').css('display', 'none');
			})

			$('#senatorClick').on('click', function(){
				$('#presidentDiv').css('display', 'none');
				$('#governorDiv').css('display', 'none');
				$('#senatorDiv').css('display', 'block');
				$('#womenDiv').css('display', 'none');
				$('#mpDiv').css('display', 'none');
				$('#mcaDiv').css('display', 'none');
			})

			$('#womenClick').on('click', function(){
				$('#presidentDiv').css('display', 'none');
				$('#governorDiv').css('display', 'none');
				$('#senatorDiv').css('display', 'none');
				$('#womenDiv').css('display', 'block');
				$('#mpDiv').css('display', 'none');
				$('#mcaDiv').css('display', 'none');
			})

			$('#mpClick').on('click', function(){
				$('#presidentDiv').css('display', 'none');
				$('#governorDiv').css('display', 'none');
				$('#senatorDiv').css('display', 'none');
				$('#womenDiv').css('display', 'none');
				$('#mpDiv').css('display', 'block');
				$('#mcaDiv').css('display', 'none');
			})

			$('#mcaClick').on('click', function(){
				$('#presidentDiv').css('display', 'none');
				$('#governorDiv').css('display', 'none');
				$('#senatorDiv').css('display', 'none');
				$('#womenDiv').css('display', 'none');
				$('#mpDiv').css('display', 'none');
				$('#mcaDiv').css('display', 'block');
			})
		})
	</script>

	

</body>
</html>