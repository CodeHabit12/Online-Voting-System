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
					<p>Registered Parties</p>
				</div>

				<div class="party">
					<table>
						<tr>
							<th width="50px">#</th>
							<th>Party Name</th>
							<th>Party Code</th>
							<th>Action</th>
							
						</tr>
						<?php
						$query=mysqli_query($conn,"select * from political_parties");
						if (mysqli_num_rows($query)>0) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
								?>
								<tr>
									<td><?php echo $sn;  ?></td>
									<td><?php echo $data['Name'];  ?></td>
									<td><?php echo '0'.$data['Code'];  ?></td>
									<td>
										<form method="post" accept="">											

											<a href="view-candidate.php?view-Id=<?php echo $data['Id'] ?>">
												<button type="button" name="view-cand">Edit</button>
											</a>

											<a href="view-candidate.php?view-Id=<?php echo $data['Id'] ?>">
												<button type="button" name="view-cand">Delete</button>
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