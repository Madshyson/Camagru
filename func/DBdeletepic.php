<?php
	require_once('./connectDb.php');
	$idpic = $_GET['idpic'];
	try
	{
		$db->beginTransaction();
		$req = $db->prepare("SELECT * FROM `pics` WHERE IDpic = ? AND IDusr = ?;");
		$req->execute(array($idpic, $_SESSION['id_usr']));
		$data = $req->fetch();
		$db->commit();
	} catch(PDOException $e) 
	{
		$db->rollBack();
		echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
	}
	if($data['PRD_pic'])
	{
		try
		{
			$db->beginTransaction();
			$req = $db->prepare("DELETE FROM `pics` WHERE IDpic = ? AND IDusr = ?;");
			$req->execute(array($idpic, $_SESSION['id_usr']));
			$db->commit();
		} catch(PDOException $e) 
		{
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
		unlink("../img/".$data['PRD_pic']);
		$_SESSION['id_pic'] = "";
		$_SESSION['img_prd'] = "";
		$_SESSION['delMsg'] = "Image supprimee";
	}
	header ("Location: ../mpics.php");
	die();
?>