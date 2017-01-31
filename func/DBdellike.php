<?php
	require_once('./connectDb.php');
	$idpic = $_GET['idpic'];
	try 
    { 
        $db->beginTransaction();
        $req = $db->prepare("SELECT * FROM `pics` ORDER BY IDpic DESC;");
        $req->execute();
        $data = $req->rowCount();
        $db->commit();
    }  catch(PDOException $e) 
	{
		$db->rollBack();
		echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
	}
	try
	{
		$db->beginTransaction();
		$req = $db->prepare("DELETE FROM `likes` WHERE IDpic = ? AND IDuser = ?");
		$req->execute(array($idpic, $_SESSION['id_usr']));
		$db->commit();
	} catch(PDOException $e) 
	{
		$db->rollBack();
		echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
	}
	header ("Location: ../pic.php?idpic=".$idpic);
	die();
?>