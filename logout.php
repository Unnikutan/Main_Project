<?php 
	include 'db/connection.php';
	session_destroy();
	header("location:index.php");
?>
