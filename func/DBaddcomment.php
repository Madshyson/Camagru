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
		try 
		{
			$db->beginTransaction();
			$req = $db->prepare("SELECT IDusr FROM `pics` WHERE IDpic = ?;");
			$req->execute(array($_SESSION['id_pic']));
			$usrpic = $req->fetch();
			$db->commit();
		} catch(PDOException $e) 
		{
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
		try 
		{
			$db->beginTransaction();
			$req = $db->prepare("SELECT email FROM `user` WHERE ID = ?;");
			$req->execute(array($usrpic['IDusr']));
			$usrmail = $req->fetch();
			$db->commit();
		} catch(PDOException $e) 
		{
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
		$subject = "On a commente un de vos photo !";
		$header = "From: infocamagru@camagru.com"; 
		$message = 'Bienvenue sur Camagru !,
 
		On a commente votre image ! allez verifier !
 
		---------------
		Ceci est un mail automatique, Merci de ne pas y répondre.';
		mail($usrmail['IDusr'], $subject, $message, $header);
		$_SESSION['submitMsg'] = "";
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