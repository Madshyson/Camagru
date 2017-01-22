<?php
	require_once('./connectDb.php');
	$_SESSION['login'] = "";
	$_SESSION["sessionMsg"] = "";
	$_SESSION["errorMsg"] = "no problem here !";
	header ("Location: ../index.php");
	die();
?>