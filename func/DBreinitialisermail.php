<?php
require_once('./connectDb.php');
if ($_POST["submit"] == "Forgot Password?" && $_POST['login'])
{
	try 
	{
		$db->beginTransaction();
		$req = $db->prepare("SELECT ID FROM `user` WHERE LOGIN = ?;");
		$req->execute(array($_POST['login']));
        $data = $req->fetch();
        $db->commit();
	} catch (PDOException $e) {
		$db->rollBack();
		echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
	}
	$newPass = rand(10000, 99999);
	$randPass = hash('whirlpool', $newPass);
	try
	{
		$db->beginTransaction();
		$req = $db->prepare("UPDATE `user` SET PASSWORD = ? WHERE ID = ?;");
	    $req->execute(array($randPass, $data['ID']));
	    $db->commit();
	} catch (PDOException $e) {
		$db->rollBack();
		echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
	}
	try
	{
		$db->beginTransaction();
		$req = $db->prepare("SELECT email FROM `user` WHERE ID = ?;");
	       $req->execute(array($data['ID']));
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
			header ("Location: ../index.php");
			die();
	       }
	} catch (PDOException $e) {
		$db->rollBack();
		echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
	}
}
header ("Location: ../index.php");
die();
?>