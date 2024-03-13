<?php
@include '../include/connection.php';
session_start();
$idno=$_SESSION['idno'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin | Counties</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
	<div class="container">
		<?php include 'include/sidebar.php'  ?>

		<div class="main">
			<div class="index">
				<?php include 'include/header.php';  ?>
				<div class="party-top">
					<p>Counties</p>
				</div>
				<input style="width: 35%; height: 40px; margin-left: 60%; border-radius: 5px; margin-top: 10px" type="search" name="search" placeholder="Search" id="live_search">
				<div class="party" id="view">
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
						$query=mysqli_query($conn,"select * from counties");
						
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
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
				<!-- <div class="chart">
					<canvas style="width: 80%; height: 50%;" id="barChart"></canvas>
				</div> -->
				
			</div>
			
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#live_search').keyup(function(){
				var county_search=$(this).val();
				if (county_search !="") {
					$.ajax({
						url: 'functions.php',
						method: 'POST',
						data: {county_search:county_search},
						success: function(data){
							$('#view').html(data)
						}
					})
				}
			})
		})
	</script>

</body>
</html>