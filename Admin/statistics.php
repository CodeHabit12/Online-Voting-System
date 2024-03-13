<?php
@include '../include/connection.php';
@include 'functions.php';
include 'include/slugify.php';
session_start();
if (isset($_SESSION['idno'])) {
	$idno=$_SESSION['idno'];

	// $mycount=counts();
	$cand_total=mysqli_fetch_row(mysqli_query($conn,"select count(IdentityNo) from candidate"))[0];
	$voter_total=mysqli_fetch_row(mysqli_query($conn,"select count(IdentityNo) from voter_account where Status=0"))[0];
	$verified_total=mysqli_fetch_row(mysqli_query($conn,"select count(IdentityNo) from voter_account where Status=1"))[0];
	$msg_total=mysqli_fetch_row(mysqli_query($conn,"select count(Id) from candimsgs"))[0];
	$msgV_total=mysqli_fetch_row(mysqli_query($conn,"select count(Id) from votermsgs"))[0];

	$title=mysqli_fetch_array(mysqli_query($conn, "select Election_Name from election"))[0];
	
}else{
	echo "<script>location.href='login.php'</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin | Statistics</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<script src="../assets/chart.js/Chart.min.js"></script>
	<script src="../assets/jquery/jquery-3.6.3.min.js"></script>
	<script src="../assets/chart.js/Chart.HorizontalBar.js"></script>
	<script src="../assets/jquery/dist/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<?php  include 'include/sidebar.php';  ?>

		<div class="main">
			<div class="index">
				<?php include 'include/header.php';  ?>
				<div class="dash">
					<marquee><p style="font-style: bold; font-size: 24px"><?php echo $title; ?></p>	</marquee>			
				</div>
				<div class="dashb">
					<label>Election data centre</label>					
				</div>

				<div class="box">
					<a href="setting.php">
						<p>Settings</p>
						<h3>Edit</h3>
					</a>
				</div>

				<div class="box">
					<a href="">
						<p>Election details</p>
						<h3>View</h3>
					</a>
				</div>

				<div class="box">
					<a href="candidates.php">
						<p>Qualified candidates</p>
						<h3><?php echo $cand_total; ?></h3>
					</a>
				</div>

				<div class="box">
					<a href="voter.php">
						<p>Registered voters</p>
						<h3><?php echo $voter_total; ?></h3>	
					</a>
				</div>

				<!-- <div class="box">
					<a href="">
						<p>Qualified candidates</p>
						<h3><?php echo $cand_total; ?></h3>
					</a>
				</div> -->

				
				<div class="box">
					<a href="">
						<p>Election statistics</p>
						<h3>View</h3>
					</a>
				</div>

				<div class="box">
					<a href="viewMsgs.php">
						<p>Messages/Notofications</p>
						<h3><?php echo $msg_total; ?> Msgs- Candidates</h3>

					</a>
				</div>

				<div class="box">
					<a href="viewMsgVoter.php">
						<p>Messages/Notofications</p>
						<h3><?php echo $msgV_total; ?> Msgs- Voters</h3>

					</a>
				</div>

				<div class="box">
					<a href="voter.php">
						<p>Verified Voters</p>
						<h3><?php echo $verified_total; ?></h3>	
					</a>
				</div>
				<div class="party" style="display: inline-flex;">
					<div style="width: 40%; height: 250px; border: 1px solid; border-radius: 5px; margin-left: 10px">
						<canvas id="myChart"></canvas>
					</div>

					
				</div>
				<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

				<?php
				$query = "SELECT COUNT(*) AS total FROM voter_account";
				$result = mysqli_fetch_assoc(mysqli_query($conn, $query));

				$query1 = "SELECT COUNT(*) AS verified FROM voter_account where Status=1";
				$result1 = mysqli_fetch_assoc(mysqli_query($conn, $query1));

				$total_voters = $result['total'];
				$verified_voters = $result1['verified'];

				$unverified_voters = $total_voters - $verified_voters;


				// Generate the JavaScript code for the pie chart
				echo "
				<script>
				var ctx = document.getElementById('myChart').getContext('2d');
				var myChart = new Chart(ctx, {
				    type: 'pie',
				    data: {
				        labels: ['Verified Voters', 'Unverified Voters'],
				        datasets: [{
				            label: 'Voter Status',
				            data: [$verified_voters, $unverified_voters],
				            backgroundColor: [
				                'rgba(54, 0, 235, 1)',
				                'rgba(255, 99, 132, 1)'
				            ],
				            borderColor: [
				                'rgba(100, 100, 235, 1)',
				                'rgba(255, 99, 132, 1)'
				            ],
				            borderWidth: 1
				        }]
				    },
				    options: {
				        responsive: true,
				        maintainAspectRatio: false
				    }
				});
				</script>
				";
				


				?>
				


				
					
</body>
</html>