<?php
	session_start();
	$db = new PDO('mysql:host=localhost;dbname=camagru', $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    if(!$_SESSION['login'])
        $_SESSION['login'] = "";
?>