<?php

include '../../include/connection.php';
if(isset($_POST['county_Id'])) {
	$sql = mysqli_query($conn, "select Name, Id_No from candidate, governor where County_Code='".$_POST['county_Id']."' and governor.IdentityNo=candidate.Id_No");
	if (mysqli_num_rows($sql)>0) {
		?>
		<div class="party">
			<h2>Governors</h2>
			<table>
				<tr>
					<th>Name</th>
					<th>Identity No</th>
				</tr>
				<?php
				foreach ($sql as $row) {
					?>
					<tr>
						<td><?php echo $row['Name'] ; ?></td>
						<td><?php echo $row['Id_No'] ; ?></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
		<?php
		
	}
}
if (!empty($_POST['county_id'])) {
	$query=mysqli_query($conn,"select * from constituencies where County_code=".$_POST['county_id']."");
	if (mysqli_num_rows($query)>0) {
		echo '<option value="">Select constituency</option>';
		while ($row=mysqli_fetch_assoc($query)) {
			echo '<option value="'.$row['Code'].'">'.$row['Name'].'</option>';
		}
		

	}else{
		echo '<option value="">Ward not available</option>';
	}

	if ($_POST['constituency_id']) {
	$sql=mysqli_query($conn, "select Name, Id_No from candidate, mps where County_Code='".$_POST['county_Id']."' and Constituency_Code='".$_POST['constituency_id']."' and IdentityNo=Id_No");
	if (mysqli_num_rows($sql)>0) {
		?>
		<div class="party">
			<h2>Governors</h2>
			<table>
				<tr>
					<th>Name</th>
					<th>Identity No</th>
				</tr>
				<?php
				foreach ($sql as $row) {
					?>
					<tr>
						<td><?php echo $row['Name'] ; ?></td>
						<td><?php echo $row['Id_No'] ; ?></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
		<?php
		
	}

}
}






?>

