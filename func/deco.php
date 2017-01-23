<?php
	require_once('./connectDb.php');
	$_SESSION['login'] = "";
	$_SESSION["sessionMsg"] = "";
	$_SESSION["errorMsg"] = "no problem here !";
	session_destroy();
	header ("Location: ../index.php");
	die();
?>