<?php
require_once('./connectDb.php');
if ($_POST["submit"] == "OK")
{
	$id = $_SESSION['id_usr'];
	$mail = $_POST["mail"];
	$log = $_POST["pseudo"];
	$mdp = hash('whirlpool', $_POST["password"]);
	if (filter_var($mail, FILTER_VALIDATE_EMAIL)) 
	{
		try
		{
			$db->beginTransaction();
			$req = $db->prepare("UPDATE `user` SET email = ? WHERE ID = ?;");
	        $req->execute(array($mail ,$id));
	        $req->execute();
	        $db->commit();
	    } catch (PDOException $e) {
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
	}
	if ($log) 
	{
		try {
			$_SESSION['login'] = $_POST["pseudo"];
			$db->beginTransaction();
			$req = $db->prepare("UPDATE `user` SET LOGIN = ? WHERE ID = ?;");
	        $req->execute(array($log ,$id));
	        $req->execute();
	        $db->commit();
	    } catch (PDOException $e) {
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
	}
	if ($mdp && strlen($mdp) >= 3) 
	{
		try
		{
			$db->beginTransaction();
			$req = $db->prepare("UPDATE `user` SET PASSWORD = ? WHERE ID = ?;");
	        $req->execute(array($mdp, $id));
	        $req->execute();
	        $db->commit();
	    } catch (PDOException $e) {
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
	}
	if (($_POST["mail"] && filter_var($mail, FILTER_VALIDATE_EMAIL)) || $_POST["pseudo"] || ($_POST["password"] && strlen($mdp) >= 3))
		$_SESSION['changeMsg'] = "vos donnees ont bien ete change !";
	else
		$_SESSION['changeMsg'] = "Remplissez les champs correctement!";
	header ("Location: ../mprofile.php");
	die();
}
?>