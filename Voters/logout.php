<?php
@ include '../include/connection.php';
session_start;
if (isset($_SESSION['username'])) {
	session_unset();
	session_destroy();
}
echo "<script>location.href='http://localhost/Online%20Voting%20System/index.php'</script>";

?>