<?php 
	session_start();

	$_SESSION['current_user'] = null;
	$_SESSION['current_name'] = null;

	header("Location: http://minicms.dev:1025/index.php");
	die();
?>