<?php
require_once('./connectDb.php');
if ($_POST["submit"] == "Forgot Password?")
{
	$newPass = rand(10000, 99999);
	$randPass = hash('whirlpool', $newPass);
	try
	{
		$db->beginTransaction();
		$req = $db->prepare("UPDATE `user` SET PASSWORD = ? WHERE ID = ?;");
	    $req->execute(array($randPass, $_SESSION['id_usr']));
	    $req->execute();
	    $db->commit();
	} catch (PDOException $e) {
		$db->rollBack();
		echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
	}
	try
	{
		$db->beginTransaction();
		$req = $db->prepare("SELECT email FROM `user` WHERE ID = ?;");
	       $req->execute(array($_SESSION['id_usr']));
	       $data = $req->fetch();
	       if($data['email'])
	       {
	       	$mail = $data['email'];
	       	$subject = "reinitialisation de votre mot de passe Camagru";
			$header = "From: signup@camagru.com"; 
			$message = 'Bienvenue sur Camagru !,
 
			Vous avez fait une demande de reinitialisation de mot de passe.
			Voici votre nouveau mot de passe,
			Changez le vite:
 
			'.$newPass.'
 

			---------------
			Ceci est un mail automatique, Merci de ne pas y répondre.';
			mail($mail, $subject, $message, $header);
			$_SESSION['changeMsg'] = "Votre mot de passe a bien ete change regardez vos mail";
			header ("Location: ../mprofile.php");
			die();
	       }
	} catch (PDOException $e) {
		$db->rollBack();
		echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
	}
}
header ("Location: ../mprofile.php");
die();
?>