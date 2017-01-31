<?php
	require_once('./connectDb.php');
	if(isset($_POST["submit"]) && is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) 
	{
		$target_dir = "../upload/";
		$filt = "../".$_POST['filter'];
    	$imageFileType = pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION);
  		$filt = imagecreatefrompng($filt);
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false && $check["mime"] == "image/png") 
        {
        	$target_file = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
			$tmp_name = $_FILES["img"]["tmp_name"];
        	unset($_SESSION["typeerror"]);
            $dest = imagecreatefrompng($_FILES["fileToUpload"]["tmp_name"]);
            try
			{
				$db->beginTransaction();
				$req = $db->prepare("INSERT INTO `pics` (`IDusr`) VALUES (?);");
				$req->execute(array($_SESSION['id_usr']));
				$db->commit();
			}
			catch(PDOException $e) 
			{
				$db->rollBack();
				echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
			}
			try 
			{
				$db->beginTransaction();
				$req = $db->prepare("SELECT IDpic FROM `pics` ORDER BY IDpic DESC LIMIT 1;");
				$req->execute(array());
				$lastpic = $req->fetch();
				$file  = "../img/";
				$filename = "img".$_SESSION['id_usr']."_".$lastpic['IDpic'].".png";
				$db->commit();
			}
			catch(PDOException $e) 
			{
				$db->rollBack();
				echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
			}
			try
			{
				$db->beginTransaction();
				$req = $db->prepare("UPDATE `pics` SET PRD_pic = ? WHERE IDpic = ?;");
				$req->execute(array($filename, $lastpic['IDpic']));
				$db->commit();
			}
			catch(PDOException $e) 
			{
				$db->rollBack();
				echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
			}
        } 
        else {
        		$_SESSION["typeerror"] = "mauvais format d'image .png accepté";
            	header ("Location: ../camagru.php");
				die();
             }
    	imagecopy($dest, $filt, 0, 0, 0, 0, 320, 240);
		imagepng($dest, $file.$filename);
		$_SESSION['img_prd'] = "./img/".$filename;
		$_SESSION['id_pic'] = $lastpic['IDpic'];
		header ("Location: ../camagru.php");
		die(); 
    }
    else
    {

        $_SESSION["typeerror"] = "pas de fichier";
    	header ("Location: ../camagru.php");
		die(); 
    }
?>
