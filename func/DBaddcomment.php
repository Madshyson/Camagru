<?php
	require_once('./connectDb.php');
	$idpic = $_GET['idpic'];
	if ($_POST['comment'] && $_POST['submit'] == 'Comment') 
	{	
		try
		{
			$db->beginTransaction();
			$req = $db->prepare("INSERT INTO `comments` (`IDpic`, `IDuser`, `com`) VALUES (?, ?, ?);");
			$req->execute(array($idpic, $_SESSION['id_usr'], htmlspecialchars($_POST['comment'])));
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
			$req->execute(array($idpic));
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
		$subject = "On a commente une de vos photos !";
		$header = "From: infocamagru@camagru.com"; 
		$message = 'Bienvenue sur Camagru !,
 
On a commente votre image ! allez verifier !
 
---------------
		Ceci est un mail automatique, Merci de ne pas y répondre.';
		mail($usrmail['email'], $subject, $message, $header);
		$_SESSION['submitMsg'] = "";
		header ("Location: ../pic.php?idpic=".$idpic);
		die();
	}
	else
	{
		header ("Location: ../pic.php?idpic=".$idpic);
		die();
	}
?>