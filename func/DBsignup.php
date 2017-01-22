<?php
    require_once('./connectDb.php');
	if ($_POST["pseudo"] && $_POST["password"] && $_POST["mail"] && $_POST["password2"]&& $_POST["submit"] == "OK")
	{
		$pseudo = $_POST["pseudo"];
		$mail = $_POST["mail"];
		header ("Location: ../signup.php");
		if($_POST["password"] != $_POST["password2"]) 
		{
			$_SESSION['errorMsg'] = "Those password don't match together";
			header ("Location: ../signup.php");
			die();
		}
		if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['errorMsg'] = "Enter a valid email adress pls";
			header ("Location: ../signup.php");
			die();
		}
		if ((strlen($_POST["password"]) < 3) && (strlen($_POST["password2"]) < 3))
		{
			$_SESSION['errorMsg'] = "that password is too short";
			header ("Location: ../signup.php");
			die();
		}
		$mdp = hash('whirlpool', $_POST["password"]);
		try {
			$db->beginTransaction();
			$req = $db->prepare("SELECT LOGIN, PASSWORD FROM `user` WHERE LOGIN = ? OR PASSWORD = ?");
			$req->execute(array($pseudo, $mdp));
			$data = $req->fetch();
			$db->commit();
		} catch (PDOException $e) {
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
		if (empty($data))
		{
			$cle = md5(microtime(TRUE)*100000);
			try
			{
				$db->beginTransaction();
				$req = $db->prepare("INSERT INTO `user` (`LOGIN`, `PASSWORD`, `email`, `validation`, `clef`) VALUES (?, ?, ?, ?, ?);");
		 		$req->execute(array($pseudo, $mdp, $mail, 0, $cle));
		 		$db->commit();
			} catch(PDOException $e) 
			{
				$db->rollBack();
				echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
			}
			// creation et envoi du mail !
			$subject = "Validation de votre compte Camagru";
			$header = "From: signup@camagru.com"; 
			$message = 'Bienvenue sur Camagru !,
 
			Pour activer votre compte, veuillez cliquer sur le lien ci dessous
			ou copier/coller dans votre navigateur internet.
 
			http://localhost:8080/Camagru/func/DBvalidation.php?log='.urlencode($pseudo).'&cle='.urlencode($cle).'
 
 
			---------------
			Ceci est un mail automatique, Merci de ne pas y répondre.';
			mail($mail, $subject, $message, $header);
			$_SESSION['errorMsg'] = "";
			$_SESSION['sessionMsg'] = "We sent you an email at your adress go check to validate your account !";
			header ("Location: ../index.php");
		}
		else
		{
			$_SESSION['errorMsg'] = "This password or this username have already been taken";
			header ("Location: ../signup.php");
		}
	}
	else
	{
		$_SESSION['errorMsg'] = "Fill up every blanks pls";
		header ("Location: ../signup.php");
	}
?>