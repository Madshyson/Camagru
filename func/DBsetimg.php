<?php
	require_once('./connectDb.php');
	$filt = $_POST["filter"];
	$img = $_POST['data'];
	//$img = str_replace('data:image/png;base64,', '', $img);
	//$img = str_replace(' ', '+', $img);
	//$img = base64_decode($img);
	var_dump($img === base64_encode(base64_decode($img)));
	$filt = imagecreatefrompng($filt);
	$dest = imagecreatefrompng($img);
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
	try {
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
	$data = imagecopy($dest, $filt, 0, 0, 0, 0, 640, 480);
	imagepng($data, $file.$filename);
	$_SESSION['img_prd'] = "./img/".$filename;
	$_SESSION['id_pic'] = $lastpic['IDpic'];
	header ("Location: ../camagru.php");
	die();
?>