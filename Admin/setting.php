<?php
include '../include/connection.php';
session_start();

if (isset($_POST['submit'])) {
	$desc=mysqli_real_escape_string($conn, $_POST['description']);
	$startdate=mysqli_real_escape_string($conn, $_POST['startdate']);

	$enddate=mysqli_real_escape_string($conn, $_POST['enddate']);
	$title=mysqli_fetch_array(mysqli_query($conn, "select Election_Name from election"))[0];

	if (!empty($desc) && !empty($startdate)  && !empty($enddate)) {
		$sql=mysqli_query($conn, "insert  into timeline(Description, startDate, endDate) values('$desc', '$startdate', '$enddate')");
		if ($sql) {
			echo "<script>alert('Inserted Successfully')</script>";
			echo "<script>location.href='setting.php'</script>";
		}else{
			echo "<script>alert('Query failed')</script>";
			echo "<script>location.href='setting.php'</script>";
		}
	}else{
		echo "<script>alert('All fields are required')</script>";
	}


}



?>
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<script type="text/javascript" src="../assets/jquery/jquery-3.6.3.min.js"></script>
<div class="container">
	<?php include 'include/sidebar.php'; ?>
	<div class="main">
		<div class="index">
			<?php include 'include/header.php' ?>
			
				<div class="candAlign" style="margin-bottom: 10px">

					<div class="dashb">
						<label>Election data centre- Election Timeline</label>
						<input type="search" name="search" id="live_search" placeholder="Search">					
					</div>

					<div class="box" id="insert" >
						<p>Insert</p>
						<p>New timeline</p>
					</div>
					
					<div class="box" id="view">
						<p>Update</p>
						<p>Timelines</p>
						
					</div>				
				</div>
				<!-- Insert div -->
				<center>
					<div class="position" style="width: 45%; margin-top: 40px;" id="insertDiv">
						<h2>Enter the start and end date for a certain event</h2>
						<form action="" method="post">							
							<label>Description</label>
							<input type="text" name="description" placeholder="Title">

							<label>Start Date</label>
							<input type="date" name="startdate" placeholder="">

							<label>Deadline</label>
							<input type="date" name="enddate" >

							<input type="submit" name="submit" value="Submit" style="cursor: pointer;">
							
						</form>
					</div>
				</center>
				
				<center>
					<div class="part" id="viewDiv" style="margin-top: 40px;">
						<h2>Timeline Records</h2>
						<table>
							<tr >
								<th width="50px">#</th>
								<th >Description</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Action</th>
							</tr>
							<?php
							$query=mysqli_query($conn,"select * from `timeline`");
							if (mysqli_num_rows($query)>0 ) {
								$sn=1;
								while ($data=mysqli_fetch_assoc($query)) {
									$desc=$data['Description'];
									?>
									<tr>

										<td><?php echo $sn;  ?></td>
										
										<td><?php echo $desc;  ?></td>
										<td><?php echo $data['startDate'];  ?></td>
										<td><?php echo $data['endDate'];  ?></td>
										
										<td>
											<form method="post" accept="">						

												<a href="editTime.php?view-Id=<?= $data['Id'] ?>">
													<button type="button" name="view-cand">Edit</button>
												</a>

												<a href="setting.php?delete_Id=<?= $data['Id'] ?>">
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
				</center>
				
				
				
			
			
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#viewDiv').hide();
		$('#update').on('click', function(){
			$('#insertDiv').css('display', 'none');
			$('#editDiv').css('display', 'block');
			$('#viewDiv').css('display', 'none');
		})

		$('#view').on('click', function(){
			$('#insertDiv').css('display', 'none');
			$('#editDiv').css('display', 'none');
			$('#viewDiv').css('display', 'block');
		})

		$('#insert').on('click', function(){
			$('#insertDiv').css('display', 'block');
			$('#editDiv').css('display', 'none');
			$('#viewDiv').css('display', 'none');
		})
	})
</script>