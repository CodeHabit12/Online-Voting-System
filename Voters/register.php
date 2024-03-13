<?php
session_start();
include '../include/connection.php';
if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];
}else{
	echo "<script>location.href='login.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
</head>
<body>
	<div class="container">
		<?php include 'include/sidebar.php' ?>
		<div class="main">
			<div class="index">
				<?php include 'include/header.php'; ?>
				<div class="form-data">
					<p>Select where you want to vote from</p>
					<form action="functions.php" method="post" enctype="multipart/form-data">
						<div class="form-entry">
							<label>Identity No.</label><br>
							<input type="number" name="idno" required value="<?php echo $idno; ?>">
						</div>

						<div class="form-entry county" id="countyDiv">
							<?php
							$query=mysqli_query($conn,"select * from counties");
							?>
							<label>County</label><br>
							<select id="county" name="countyName" required>
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
							</select>
						</div>

						<div class="form-entry sub_county" id="constituencyDiv">
							
							<label>Constituency</label><br>
							<select name="constituencyName" id="constituency" required>
								<option value="">Select county first</option>
								
							</select>
						</div>

						<div class="form-entry ward" id="wardDiv">							
							<label>Ward</label><br>
							<select name="wardName" id="ward" required>
								<option value="">Select constituency first</option>								
							</select>
						</div>

						<div class="form-entry">
							<div class="btn-submit">
								<input type="submit" name="voteLocation" value="Submit to continue">
							</div>
						</div>
					</form>
				
			</div>
			
		</div>
	</div>
	<script type="text/javascript" src="include/script.js"></script>

</body>
</html>