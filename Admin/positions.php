<?php
include '../include/connection.php';
session_start();
if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin | Positions</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
	<div class="container">
		<?php include 'include/sidebar.php' ?>
		<div class="main">
			<div class="index">
				<?php include 'include/header.php';  ?>
				<div class="candAlign">

					<div class="dashb">
						<label>Election data centre- Positions</label>
						<input type="search" name="search" placeholder="Search">					
					</div>

					<div class="box" id="addposition" >
						<p>Add Position</p>
						<!-- <h3><?php echo $candTotal; ?> candidate(s)</h3> -->
					</div>

					<div class="box" id="electionView" >
						<p>Add/Manage Election</p>
						<!-- <h3><?php echo $candTotal; ?> candidate(s)</h3> -->
					</div>
					
					<div class="box" id="managepos" >
						<p>Manage Position</p>
						<!-- <h3><?php echo $president; ?> candidate(s)</h3> -->
					</div>

					<div id="countyActivate" class="box">
						<p>Counties</p>
						<!-- <h3><?php echo $governor; ?></h3> -->
					</div>

					<!-- <div id="Constituencies" class="box">
						<p>Constituencies</p>
						<h3><?php echo $senator; ?></h3>	
					</div>
				
				
				
					<div id="w_rep" class="box">
						<p>Wards</p>
						<h3><?php echo $w_rep; ?></h3>
					</div> -->					
					
				</div>
				<div class="party" id="governors">
					<div class="party" >
						<label>Select County</label>
						<select name="countyName" id="countyName">
							<option>Select County</option>
							<?php
							$sql=mysqli_query($conn, "select * from counties");
							if (mysqli_num_rows($sql)>0) {
								while ($row=mysqli_fetch_assoc($sql)) {
									?>
									<option value="<?=$row['Code'] ?>"><?php echo $row['Name'] ?></option>						
									<?php
								}
							}
							?>
						</select>	
								
					</div>
					<div class="party1" id="tableView">

					</div>
				</div>

				<div class="party" id="constituencyDiv">
					<div class="party">
						<?php
						$query=mysqli_query($conn,"select * from counties");
						?>
						<label>County</label>
						<select id="mp_county" name="countyName" required>
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
					</div>
					<div class="party1" id="mpView">

					</div>
				</div>
				
				
				<div class="position" id="position">
					<h2>Add Position</h2>										
					<form action="functions.php" method="post">
						<label>Position Name</label><br>
						<input type="text" name="position">
						<label>Position Code</label><br>
						<input type="text" name="code">
						<button name="add-position">Submit</button>
					</form>
				</div>

				<div class="position" id="election">
					<h2>Add Election</h2>										
					<form action="functions.php" method="post">
						<label>Election Name</label><br>
						<input type="text" name="position">
						<label>Election Code</label><br>
						<input type="text" name="code">
						<button name="add-election">Submit</button>
					</form>
				</div>
				
				<div class="party" id="positionDiv">
					<table>
						<tr>
							<th width="50px">#</th>
							<th>Position Name</th>
							<th>Position Code</th>
							<th>Action</th>
							
						</tr>
						<?php
						$query=mysqli_query($conn,"select * from Positions");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
								?>
								<tr>
									<td><?php echo $sn;  ?></td>
									<td><?php echo $data['Seat_Name'];  ?></td>
									<td><?php echo $data['Seat_Code'];  ?></td>
									<td>
										<form method="post" accept="">										

											<!-- <a href="view-candidate.php?view-Id=<?php echo $data['Id'] ?>">
												<button style="width: 45%" type="button" name="view-cand">Edit</button>
											</a> -->

											<a href="functions.php?delete_pos=<?= $data['Id'] ?>">
												<button style="width: 90%" onclick="return confirm('Are you sure you want to delete this?')" type="button" name="view-cand">Delete</button>
											</a>
										</form>
									</td>
									
								</tr>
								<?php
								$sn++;
							}
						}
						else{
							?>
							<tr>
								<td colspan="9"><h1>No data found</h1> </td>
							</tr>
							<?php
						}

						?>
					</table>
					
				</div>

				<div class="party" id="electionDiv">
					<table>
						<tr>
							<th width="50px">#</th>
							<th>Election Name</th>
							<th>Election Code</th>
							<th>Action</th>
							
						</tr>
						<?php
						$query=mysqli_query($conn,"select * from election");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
								?>
								<tr>
									<td><?php echo $sn;  ?></td>
									<td><?php echo $data['Election_Name'];  ?></td>
									<td><?php echo $data['Election_Code'];  ?></td>
									<td>
										<form method="post" accept="">										

											<a href="view-candidate.php?view-Id=<?php echo $data['Id'] ?>">
												<button style="width: 45%" type="button" name="view-cand">Update</button>
											</a>

											<a href="functions.php?delete_pos=<?= $data['Id'] ?>">
												<button style="width: 90%" onclick="return confirm('Are you sure you want to delete this?')" type="button" name="view-cand">Delete</button>
											</a>
										</form>
									</td>
									
								</tr>
								<?php
								$sn++;
							}
						}
						else{
							?>
							<tr>
								<td colspan="9"><h1>No data found</h1> </td>
							</tr>
							<?php
						}

						?>
					</table>
					
				</div>
				
				
			</div>
		</div>
		
	</div>

	<!-- Governor's Name view -->
	<script type="text/javascript">
		$(document).ready(function(){
	    	$("#countyName").on('change', function() {
		        var countyId=$(this).val();
		        alert(countyId);
	        // var dataString = 'county_Id='+ id;
	        	if (countyId) {
		        	$.ajax({
		        	type: 'POST',
		            url: 'include/viewData.php',	            
		            data: 'county_Id='+countyId,
		            cache: false,
		            success: function(employeeData) {
		                 if(employeeData) {
		                    $('#tableView').html(employeeData);
		                	} 
		            	}
		        	});
	        	}
	    	});
		});
	</script>

	<!-- Hide show -->
	<script type="text/javascript">
		$('#election').css('display', 'none');
		$('#position').css('display', 'block');
		$('#positionDiv').css('display', 'none');
		$('#electionDiv').css('display', 'none');
		$('#governors').css('display', 'none');
		$('#constituencyDiv').css('display', 'none');
		$('#addposition').on('click', function(){
			$('#position').css('display', 'block');
			$('#election').css('display', 'none');
			$('#positionDiv').css('display', 'none');
			$('#electionDiv').css('display', 'none');
			$('#governors').css('display', 'none');
			$('#Constituencies').css('display', 'none');
		});
		$('#electionView').on('click', function(){
			$('#election').css('display', 'block');
			$('#position').css('display', 'none');
			$('#electionDiv').css('display', 'block');
			$('#positionDiv').css('display', 'none');
			$('#governors').css('display', 'none');
			$('#Constituencies').css('display', 'none');
		});
		$('#managepos').on('click', function(){
			$('#election').css('display', 'none');
			$('#position').css('display', 'none');
			$('#electionDiv').css('display', 'none');
			$('#governors').css('display', 'none');
			$('#positionDiv').css('display', 'block');
			$('#Constituencies').css('display', 'none');
		});
		$('#countyActivate').on('click', function(){
			$('#election').css('display', 'none');
			$('#position').css('display', 'none');
			$('#positionDiv').css('display', 'none');
			$('#electionDiv').css('display', 'none');
			$('#governors').css('display', 'block');
			$('#Constituencies').css('display', 'none');
		});
		$('#Constituencies').on('click', function(){
			$('#election').css('display', 'none');
			$('#position').css('display', 'none');
			$('#electionDiv').css('display', 'none');
			$('#governors').css('display', 'none');
			$('#constituencyDiv').css('display', 'block');
		});
		
	</script>

	<!-- Mp Name view -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#mp_county').on('change',function(){
				var countyId=$(this).val();
				if (countyId) {
					$.ajax({
						type: 'POST',
						url: 'include/viewData.php',
						data: 'county_id='+countyId,
						success: function(html){
							$('#mp_constituency').html(html);
						}
					});
				}else{
					$('#mp_constituency').html('<option value="">Select county first</option>');
					$('#mp_ward').html('<option value="">Select constituency first</option>');
				}
			});
			$('#mp_constituency').on('change', function(){
				var constituencyId = $(this).val();
				alert(constituencyId);
				if (constituencyId) {
					$.ajax({
						type: 'POST',
						url: 'include/viewData.php',
						data: 'constituency_id='+constituencyId,
						success: function(html){
							$('#mpView').html(html);
						}
					});
				}else{
					$('#mpView').html('<p>Select constituency first</p>');
				}
			});
		});
	</script>

</body>
</html>