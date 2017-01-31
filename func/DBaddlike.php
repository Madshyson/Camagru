<?php
	require_once('./connectDb.php');
	$idpic = $_GET['idpic'];
	try 
	{
		$db->beginTransaction();
		$req = $db->prepare("SELECT * FROM `likes` WHERE IDpic = ? AND IDuser = ?;");
		$req->execute(array($idpic, $_SESSION['id_usr']));
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
			$req->execute(array($idpic, $_SESSION['id_usr']));
			$db->commit();
		} catch(PDOException $e) 
		{
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
	}
		header ("Location: ../pic.php?idpic=".$idpic);
	die();
?>