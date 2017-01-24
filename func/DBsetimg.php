<?php
	require_once('./connectDb.php');
	$array = array_values($_POST);
	$filt = imagecreatefrompng($array[1]);
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
		$upload_dir = "../img/";
		$filename = "img".$_SESSION['id_usr']."_".$lastpic['IDpic'].".png";
		$img = $array[0];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = $upload_dir;
		$success1 = file_put_contents($file, $data);
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
		$req->execute(array($filename));
		$db->commit();
	}
	catch(PDOException $e) 
	{
		$db->rollBack();
		echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
	}
	$dest = imagecreatefrompng($upload_dir.$filename);
	$data = imagecopymerge($dest, $filt, 10, 9, 0, 0, 181, 640, 480);
	$success2 = file_put_contents($file, $data);
	header ("Location: ../camagru.php");
	die();
?>