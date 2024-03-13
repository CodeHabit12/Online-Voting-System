<?php
@include '../include/connection.php';
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
					<p>Constituencies</p>
				</div>

				<div class="party">
					<table>
						<tr>
							<th width="50px">#</th>
							<th>Constituency Name</th>
							<th>Constituency Code</th>
							<th>Email</th>
							<th>Reg Voters</th>
							<th>Action</th>
						</tr>
						<?php
						$id=$_GET['view-Id'];
						$query=mysqli_query($conn, "select * from constituencies where County_code='$id'");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
								$idd=$data['Code'];
								$voter=mysqli_fetch_array(mysqli_query($conn, "select count(IdentityNo) from Location where Constituency='$idd'"))[0];
								?>
								<tr>
									<td><?php echo $sn;  ?></td>
									<td><?php echo $data['Name'];  ?></td>
									<td><?php echo '0'.$data['Code'];  ?></td>
									<td><?php echo $data['Hotline_Email'];  ?></td>
									<td><?php echo $voter;  ?> Voters</td>
									<td>
										<form method="post" accept="">
											<a href="ward.php?view-Id=<?php echo $data['Code'] ?>">
												<button style="width: 100%" type="button" name="view-cand">View Details</button>
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
	

</body>
</html>