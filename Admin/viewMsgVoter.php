<?php
session_start();
@include '../include/connection.php';
if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin|View Messages</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
	<div class="container">
		<?php include 'include/sidebar.php' ?>
		<div class="main">
			<div class="index">
				<?php include 'include/header.php' ?>
				<div class="party-top">
					<p>Messages and notifications</p>
				</div>
				
				<div class="party">
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
						$query=mysqli_query($conn,"select * from votermsgs");
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

</body>
</html>