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
	<title>Admin | Voters</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
	<div class="container">
		<?php include 'include/sidebar.php'  ?>

		<div class="main">
			<div class="index">
				<?php include 'include/header.php';  ?>
				<div class="party-top">
					<p>Voters</p>
				</div>

				<div class="party">
					<table>
						<tr>
							<th width="50px">#</th>
							<th>Front(Id)</th>
							<th>Front(Back)</th>
							<th>Name</th>
							<th>Id No.</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Gender</th>
							<th>Action</th>
						</tr>
						<?php
						$query=mysqli_query($conn,"select * from voter_account, id_table where voter_account.IdentityNo=id_table.IdentityNo");
						if (mysqli_num_rows($query)>0 ) {
							$sn=1;
							while ($data=mysqli_fetch_assoc($query)) {
								$name=$data['Name'];
								?>
								<tr>

									<td><?php echo $sn;  ?></td>
									<td><img style="width: 100px;height: 100px;" src="../assets/images/<?php echo $data['Id_Front']; ?>"> </td>
									<td><img style="width: 100px;height: 100px;" src="../assets/images/<?php echo $data['Id_Back']; ?>"> </td>
									<td><?php echo $name;  ?></td>
									<td><?php echo $data['IdentityNo'];  ?></td>
									<td><?php echo $data['phone'];  ?></td>
									<td><?php echo $data['Email'];  ?></td>
									<td><?php echo $data['Gender'];  ?></td>
									<td>
										<form method="post" accept="">
											<a href="view-voter.php?view-Id=<?= $data['id'] ?>">
												<button type="button"  name="view-cand">View</button>
											</a>

											<a href="config-voter.php?view-Id=<?= $data['id'] ?>">
												<button type="button" name="view-cand">Edit</button>
											</a>

											<a href="functions.php?delete_Id=<?= $data['id'] ?>">
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
				
			</div>
			
		</div>
	</div>
	

</body>
</html>