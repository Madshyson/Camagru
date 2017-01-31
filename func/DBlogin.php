<?PHP
	require_once('./connectDb.php');
	if ($_POST["login"] && $_POST["password"] && $_POST["submit"] == "OK")
	{
		$mdp = hash('whirlpool', $_POST["password"]);
		try {
			$db->beginTransaction();
			$req = $db->prepare("SELECT ID, LOGIN, PASSWORD, validation FROM `user` WHERE LOGIN = ? AND PASSWORD = ?;");
			$req->execute(array(htmlspecialchars($_POST['login']), $mdp));
			$data = $req->fetch();
			if ($data['LOGIN'] == htmlspecialchars($_POST["login"]) && $data['PASSWORD'] == $mdp) 
			{
            	if ($data['validation']) {
                	$_SESSION['login'] = $data['LOGIN'];
                	$_SESSION['id_usr'] = $data['ID'];
                	header ("Location: ../camagru.php");
            	}
            	else 
            	{
                	$_SESSION['sessionMsg'] = "Vous n'avez pas validé votre compte";
                	header ("Location: ../index.php");
            	}
        	}
        	else 
        	{
            	$_SESSION['sessionMsg'] = "login ou mot de passe incorect";
            	header ("Location: ../index.php");
        	}
		} catch (PDOException $e) {
			$db->rollBack();
			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
		}
	}
	else
	{
		$_SESSION['sessionMsg'] = "Fill up every blanks pls";
		header ("Location: ../index.php");
	}
?>