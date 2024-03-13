<?php
@include '../include/connection.php';
session_start();
if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];
	$candTotal=mysqli_fetch_row(mysqli_query($conn,"select count(id) from candidate "))[0];
	$president=mysqli_fetch_row(mysqli_query($conn,"select count(id) from candidate where Position_id=1 "))[0];
	$governor=mysqli_fetch_row(mysqli_query($conn,"select count(GavId) from governor"))[0];
	$senator=mysqli_fetch_row(mysqli_query($conn,"select count(SenId) from senator"))[0];
	$w_rep=mysqli_fetch_row(mysqli_query($conn,"select count(WomId) from Women_rep"))[0];
	$mp=mysqli_fetch_row(mysqli_query($conn,"select count(MpId) from mps"))[0];
	$mca=mysqli_fetch_row(mysqli_query($conn,"select count(McaId) from mcas"))[0];
	$msg=mysqli_fetch_row(mysqli_query($conn,"select count(Sender_Id) from candimsgs"))[0];
	
}else{
	echo "<script>location.href='login.php'</script>";
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin | Candidates</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
	<div class="container">
		<?php include 'include/sidebar.php';  ?>
		<div class="main">
			<div class="index">
				<?php include 'include/header.php';  ?>
				<div class="candAlign">

					<div class="dashb">
						<label>Election data centre- Candidate Page</label>
						<input type="search" name="search" id="live_search" placeholder="Search">					
					</div>

					<div class="box" id="viewAll" >
						<p>All Candidates</p>
						<h3><?php echo $candTotal; ?> candidate(s)</h3>
					</div>
					
					<div class="box" id="president" >
						<p>Vying for Presidential Seat</p>
						<h3><?php echo $president; ?> candidate(s)</h3>
					</div>

					<div id="governor" class="box">
						<p >Vying for gubernatorial Seat</p>
						<h3><?php echo $governor; ?></h3>
					</div>

					<div id="senator" class="box">
						<p>Vying for senetorial seat</p>
						<h3><?php echo $senator; ?></h3>	
					</div>
				
				
				
					<div id="w_rep" class="box">
						<p>Women reps</p>
						<h3><?php echo $w_rep; ?></h3>
					</div>
				

				
					<div id="mp" class="box">
						<p>Member of parliament</p>
						<h3><?php echo $mp; ?></h3>
					</div>
			

				
					<div id="mca" class="box">
						<p>Member of County Assembly</p>
						<h3><?php echo $mca; ?></h3>
					</div>
				

				
					<div class="box" id="msgs">
						<p>Messages/Notofications</p>
						<h3><?php echo $msg; ?> Msgs</h3>
					</div>
					
				</div>
				
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
						$query=mysqli_query($conn,"select * from candidate, id_table where candidate.IdentityNo=id_table.IdentityNo");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
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
											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">View</button>
											</a>

											<a href="edit-cand.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">Edit</button>
											</a>

											<a href="functions.php?delete_cand_Id=<?= $data['id'] ?>">
												<button onclick="return confirm('Are you sure you want to delete this?')" type="button" name="view-cand">Delete</button>
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

				<div class="party" id="presidentDiv" style="display: none;">
					<div class="party-top">
						<p>Registered candidates- President</p>
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
						$query=mysqli_query($conn,"select * from candidate,id_table where candidate.IdentityNo=id_table.IdentityNo and Position_Id=1");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
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
											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">View</button>
											</a>

											<a href="edit-cand.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">Edit</button>
											</a>

											<a href="functions.php?delete_cand_Id=<?= $data['id'] ?>">
												<button onclick="return confirm('Are you sure you want to delete this?')" type="button" name="view-cand">Delete</button>
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

				<div class="party" id="governorDiv" style="display: none;">
					<div class="party-top">
						<p>Registered candidates- Governor</p>
					</div>
					<table>
						<tr>
							<th width="50px">#</th>
							<th>Name</th>
							<th>Id No.</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>County Code</th>
							<th>Party Code</th>
							<th>Action</th>
						</tr>
						<?php
						$query=mysqli_query($conn,"select * from candidate,governor, id_table where candidate.IdentityNo=governor.IdentityNo and governor.IdentityNo=id_table.IdentityNo");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
								?>
								<tr>
									<td><?php echo $sn;  ?></td>
									<td><?php echo $data['Name'];  ?></td>
									<td><?php echo $data['IdentityNo'];  ?></td>
									<td><?php echo $data['Email'];  ?></td>
									<td><?php echo $data['Phone'];  ?></td>
									<td>0<?php echo $data['County_Code'] ?></td>
									<td><?php echo $data['Political_Party'];  ?></td>
									
									<td>
										<form method="post" accept="">
											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">View</button>
											</a>

											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">Edit</button>
											</a>

											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button style="background: red;" type="button" name="view-cand">Delete</button>
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

				<div class="party" id="w_repDiv" style="display: none;">
					<div class="party-top">
						<p>Registered candidates- Women Representative</p>
					</div>
					<table>
						<tr>
							<th width="50px">#</th>
							<th>Name</th>
							<th>Id No.</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>County Code</th>
							<th>Party Code</th>							
							<th>Action</th>
						</tr>
						<?php
						$query=mysqli_query($conn,"select * from candidate,Women_rep, id_table where candidate.IdentityNo=Women_rep.IdentityNo and id_table.IdentityNo=Women_rep.IdentityNo");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
								?>
								<tr>
									<td><?php echo $sn;  ?></td>
									<td><?php echo $data['Name'];  ?></td>
									<td><?php echo $data['IdentityNo'];  ?></td>
									<td><?php echo $data['Email'];  ?></td>
									<td><?php echo $data['Phone'];  ?></td>
									<td>0<?php echo $data['County_Code'] ?></td>
									<td><?php echo $data['Political_Party'];  ?></td>
									
									<td>
										<form method="post" accept="">
											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">View</button>
											</a>

											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">Edit</button>
											</a>

											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button style="background: red;" type="button" name="view-cand">Delete</button>
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

				<div class="party" id="senatorDiv" style="display: none;">
					<div class="party-top">
						<p>Registered candidates- Senators</p>
					</div>
					<table>
						<tr>
							<th width="50px">#</th>
							<th>Name</th>
							<th>Id No.</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>County Code</th>
							<th>Party Code</th>
							<th>Action</th>
						</tr>
						<?php
						$query=mysqli_query($conn,"select * from candidate,senator, id_table where candidate.IdentityNo=senator.IdentityNo and id_table.IdentityNo=senator.IdentityNo");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
								?>
								<tr>
									<td><?php echo $sn;  ?></td>
									<td><?php echo $data['Name'];  ?></td>
									<td><?php echo $data['IdentityNo'];  ?></td>
									<td><?php echo $data['Email'];  ?></td>
									<td><?php echo $data['Phone'];  ?></td>
									<td>0<?php echo $data['County_Code'] ?></td>
									<td><?php echo $data['Political_Party'];  ?></td>
									
									<td>
										<form method="post" accept="">
											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">View</button>
											</a>

											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">Edit</button>
											</a>

											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button style="background: red;" type="button" name="view-cand">Delete</button>
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

				<div class="party" id="mpDiv" style="display: none;">
					<div class="party-top">
						<p>Registered candidates- Member of Parliament</p>
					</div>
					<table>
						<tr>
							<th width="50px">#</th>
							<th>Name</th>
							<th>Id No.</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>County Code</th>
							<th>Constituency Code</th>
							<th>Party Code</th>
							<th>Action</th>
						</tr>
						<?php
						$query=mysqli_query($conn,"select * from candidate,mps, id_table where candidate.IdentityNo= mps.IdentityNo and id_table.IdentityNo=mps.IdentityNo ");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
								?>
								<tr>
									<td><?php echo $sn;  ?></td>
									<td><?php echo $data['Name'];  ?></td>
									<td><?php echo $data['IdentityNo'];  ?></td>
									<td><?php echo $data['Email'];  ?></td>
									<td><?php echo $data['Phone'];  ?></td>
									<td>0<?php echo $data['County_Code'] ?></td>
									<td>0<?php echo $data['Constituency_Code'] ?></td>
									<td><?php echo $data['Political_Party'];  ?></td>
									
									<td>
										<form method="post" accept="">
											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">View</button>
											</a>

											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">Edit</button>
											</a>

											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button style="background: red;" type="button" name="view-cand">Delete</button>
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

				<div class="party" id="mcaDiv" style="display: none;">
					<div class="party-top">
						<p>Registered candidates- MCA's</p>
					</div>
					<table>
						<tr>
							<th width="50px">#</th>
							<th>Name</th>
							<th>Id No.</th>
							<th>Email</th>
							<th>Phone Number</th>
							<th>County Code</th>
							<th>Constituency Code</th>
							<th>Ward Code</th>
							<th>Party Code</th>
							<th>Action</th>
						</tr>
						<?php
						$query=mysqli_query($conn,"select * from candidate,mcas, id_table where candidate.IdentityNo=mcas.IdentityNo and id_table.IdentityNo=mcas.IdentityNo ");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
								?>
								<tr>
									<td><?php echo $sn;  ?></td>
									<td><?php echo $data['Name'];  ?></td>
									<td><?php echo $data['IdentityNo'];  ?></td>
									<td><?php echo $data['Email'];  ?></td>
									<td><?php echo $data['Phone'];  ?></td>
									<td>0<?php echo $data['county'] ?></td>
									<td>0<?php echo $data['Constituency'] ?></td>
									<td>0<?php echo $data['ward'] ?></td>
									<td><?php echo $data['Political_Party'];  ?></td>
									
									<td>
										<form method="post" accept="">
											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">View</button>
											</a>

											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button type="button" name="view-cand">Edit</button>
											</a>

											<a href="view-candidate.php?view-Id=<?php echo $data['id'] ?>">
												<button style="background: red;" type="button" name="view-cand">Delete</button>
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
					
				<div class="party" id="messages" style="display: none;">
					<div class="party-top">
						<p>Messages and notifications</p>
					</div>
					<table>
						<tr>
							<th>#</th>
							<th>Sender's Name</th>
							<th>Sender's Id</th>
							<!-- <th>Time</th> -->
							<th>Message</th>
							<th>Attachment</th>
						</tr>
						<?php
						$query=mysqli_query($conn,"select * from candimsgs");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
								?>
								<tr>
									<td><?php echo $sn;  ?></td>
									<td><?php echo $data['Sender_Name'];  ?></td>
									<td><?php echo $data['Sender_Id'];  ?></td>
									<!-- <td><?php echo $data['reg_time'];  ?></td> -->
									<td><?php echo $data['message'];  ?></td>
									<!-- <td><?php echo $data['Document'];  ?></td> -->
									<td>
										<form method="post" accept="" style="margin: 5px; font-size: 18px;">
											<a style="text-decoration: none;" href=""><?php echo $data['Document'];  ?>
												<button>View</button>
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
	<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
	<script type="text/javascript" src="../assets/javascript/hide.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#live_search').keyup(function(){
				var input=$(this).val();
				if (input!="") {
					$.ajax({
						url: 'functions.php',
						method: 'POST',
						data: {input: input},

						success: function(data){
							$('#allDiv').html(data);
						}
					})
				}
			})
		})
	</script>

</body>
</html>