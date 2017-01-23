<?php
	require_once('./connectDb.php');
	if ($_POST['comment'] && $_POST['submit'] == 'OK') 
	{	
		try
		{
			$db->beginTransaction();
			$req = $db->prepare("INSERT INTO `comments` (`IDpic`, `IDuser`, `text`) VALUES (?, ?, ?);");
			$req->execute(array($_SESSION['id_pic'], $_SESSION['id_usr'], $_POST['comment']));
			$db->commit();
		} catch(PDOException $e) 
		{
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
		header ("Location: ../gallery.php");
		die();
	}
	else
	{
		$_SESSION['submitMsg'] = "veuillez rentrer du texte";
		header ("Location: ../gallery.php");
		die();
	}
?>