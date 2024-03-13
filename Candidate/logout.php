<?php
@ include '../include/connection.php';
session_start;
if (isset($_SESSION['idno'])) {
	session_unset();
	session_destroy();
}
echo "<script>location.href='../index.php'</script>";

?>