<?php
	require_once('./connectDb.php');
	if ($_POST['submit'] == 'delete') 
	{	
		try
		{
			$db->beginTransaction();
			$req = $db->prepare("DELETE FROM `pics` WHERE IDpic = ?;");
			$req->execute(array($_SESSION['id_pic']));
			$db->commit();
		} catch(PDOException $e) 
		{
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
		$_SESSION['delMsg'] = "Image supprimee";
		header ("Location: ../mpics.php");
		die();
	}
	else
	{
		$_SESSION['delMsg'] = "erreur lors de la suppresion";
		header ("Location: ../mpics.php");
		die();
	}
?>