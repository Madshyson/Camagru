<?php
	require_once('./connectDb.php');
	try 
	{
		$db->beginTransaction();
		$req = $db->prepare("SELECT * FROM `likes` WHERE IDpic = ? AND IDuser = ?;");
		$req->execute(array($_POST['login'], $mdp));
		$data = $req->fetch();
		$db->commit();
	}	catch(PDOException $e) 
	{
		$db->rollBack();
		echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
	}
	if (!$data)
	{
		try
		{
			$db->beginTransaction();
			$req = $db->prepare("INSERT INTO `likes` (`IDpic`, `IDuser`) VALUES (?, ?);");
			$req->execute(array($_SESSION['id_pic'], $_SESSION['id_usr']));
			$db->commit();
		} catch(PDOException $e) 
		{
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
	}
	header ("Location: ../gallery.php");
	die();
?>