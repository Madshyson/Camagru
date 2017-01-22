<?php
	require_once('./connectDb.php');
	$cle = $_GET['cle'];
	$login = $_GET['log'];
	try
	{
		$db->beginTransaction();
		$req = $db->prepare("SELECT clef FROM `user` WHERE LOGIN = ?");
		$req->execute(array($login));
		$data = $req->fetch();
		$db->commit();
	} catch (PDOException $e) {
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
	if ($data['clef'] == $cle)
	{
		try 
		{
			$db->beginTransaction();
			$req = $db->prepare("UPDATE `user` SET validation = 1 WHERE LOGIN = ?;");
          	$req->execute(array($login));
          	$req->execute();
          	$db->commit();
		} catch (PDOException $e) {
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
		$_SESSION['sessionMsg'] = "You are registered and you can now enter the site !";
		header ("Location: ../index.php");
		die();
	}
	else
	{
		$_SESSION['sessionMsg'] = "We couldn't register you, please try again";
		header ("Location: ../index.php");
		die();
	}
?>