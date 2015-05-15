<?php
	session_start();
	require_once "../includes/configuration.php";
	require_once "../includes/classes/class.database.php";

	$_SESSION['username']='';
	$_SESSION['password']='';
	session_destroy();
	header("location:index.php");
	exit;
?>