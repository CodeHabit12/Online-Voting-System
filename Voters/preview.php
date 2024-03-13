<?php  include '../include/connection.php'; 
include 'functions.php'; 
if (isset($_POST['idno'])) {
	$idno=$_SESSION['idno'];
	$sql=mysqli_query($conn,"select * from voter_account where IdentityNo='$idno'");
	$title=mysqli_fetch_array(mysqli_query($conn, "select Election_Name from election"))[0];
	if (mysqli_num_rows($sql)>0) {
		while ($row=mysqli_fetch_assoc($sql)) {
			$voterID=$row['IdentityNo'];
		}
	}
}
?>
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<div class="party-top">
	<p>Candidates Elected</p>
</div>

<div class="party">
	<table>
		<tr>
			<th width="50px">#</th>
			<th>President</th>
			<th>Governor</th>
			<th>Women Represenative</th>
			<th>Senator</th>
			<th>Member of Parliament</th>
			<th>MCA</th>
		</tr>
		<?php
		$query=mysqli_query($conn,"select * from Votes where IdentityNo='$voterID'");
		if (mysqli_num_rows($query)>0) {
			$sn=1;
			while ($data=mysqli_fetch_assoc($query)) {
				$presId=$data['President'];
				$presName=mysqli_fetch_array(mysqli_query($conn, "select Name from id_table where IdentityNo='$presId'"))[0];

				$govId=$data['Governor'];
				$govName=mysqli_fetch_array(mysqli_query($conn, "select Name from id_table where IdentityNo='$govId'"))[0];

				$senId=$data['Senator'];
				$senName=mysqli_fetch_array(mysqli_query($conn, "select Name from id_table where IdentityNo='$senId'"))[0];

				$womId=$data['Women_Rep'];
				$womName=mysqli_fetch_array(mysqli_query($conn, "select Name from id_table where IdentityNo='$womId'"))[0];

				$mpId=$data['MP'];
				$mpName=mysqli_fetch_array(mysqli_query($conn, "select Name from id_table where IdentityNo='$mpId'"))[0];

				$mcaId=$data['MCA'];
				$mcaName=mysqli_fetch_array(mysqli_query($conn, "select Name from id_table where IdentityNo='$mcaId'"))[0];
				?>
				<tr>
					<td><?php echo $sn;  ?></td>
					<td><?php echo $presName;  ?></td>
					<td><?php echo $govName;  ?></td>
					<td><?php echo $senName;  ?></td>
					<td><?php echo $womName;  ?></td>
					<td><?php echo $mpName;  ?></td>
					<td><?php echo $mcaName;  ?></td>
					
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