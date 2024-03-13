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
	<title>Admin | Parties </title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
	<div class="container">
		<?php include 'include/sidebar.php';  ?>

		<div class="main">
			<div class="index">
				<?php include 'include/header.php';  ?>

				<div class="party-top">
					<p>List of registered parties</p>					
				</div>
				<div class="party">
					<table>
						<th style="width: 40px;">Id</th>
						<th>Name</th>
						<th>Code</th>

						<tr>
							<td>1.</td>
							<td>Odm party</td>
							<td>ODM001</td>
						</tr>
						<tr>
							<td>1.</td>
							<td>Odm party</td>
							<td>ODM001</td>
						</tr>
						<tr>
							<td>1.</td>
							<td>Odm party</td>
							<td>ODM001</td>
						</tr>
						<tr>
							<td>1.</td>
							<td>Odm party</td>
							<td>ODM001</td>
						</tr>
					</table>
					
				</div>
			</div>
			
		</div>
	</div>

</body>
</html>