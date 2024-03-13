<?php
include 'include/connection.php';
$title=mysqli_fetch_array(mysqli_query($conn, "select Election_Name from election"))[0];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Voting System</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/magicscroll/magicscroll.css">
	<script src="assets/magicscroll/magicscroll.js"></script>
</head>
<body>	
	<div class="container" style="display: block;">
    	<div class="header">
	      <img src="https://cdn-icons-png.flaticon.com/512/888/888879.png" alt="Online voting logo">
	      <h1>Online Voting System</h1>
	      <img src="https://cdn-icons-png.flaticon.com/512/888/888879.png" alt="Online voting logo">
	    </div>
	    <div class="nav">
	      <a href="index.php">Home</a>
	      <a href="about.php">About</a>
	      <a href="admin/login.php">Admin</a>
	      <a href="Candidate/login.php">Candidate</a>
	      <a href="Voters/login.php">Voter</a>
	      <a href="contact.php">Contact</a>
	    </div>
	    <div class="mainDiv">
	     <div class="card">
	       <img src="../assets/images/download.jpg" alt="Voting ballot">
	       <h3>"The ballot is stronger than the bullet." - Abraham Lincoln</h3>
	       <button>Vote Now</button>
	     </div>
	     <div class="card">
	       <img src="../assets/images/download.jpg" alt="Voting poster">
	       <h3>"The future of this republic is in the hands of the American voter." - Dwight D. Eisenhower</h3>
	       <a href=""><button>Vote Now</button></a>
	     </div>
	     <div class="card">
	       <img src="../assets/images/download.jpg" alt="Voting pin">
	       <h3>"Bad officials are elected by good citizens who do not vote." - George Jean Nathan</h3>
	       <button>Vote Now</button>
	     </div>
	   </div>
	   <div class="footer">
	     <p>© Online Voting System. All rights reserved.</p>
	   </div>
 	</div>
</body>
</html>