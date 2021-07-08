<?php
	
	session_start();
	
	require_once '../inc/functions.php';

	$_SESSION["user_id"] = null;
	$_SESSION["username"] = null;

	session_destroy();

	redirect_to("login.php");

?>
