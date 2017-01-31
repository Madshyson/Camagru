<?php
$idpic = $_GET['idpic'];
 try {
        $db->beginTransaction();
        $req = $db->prepare("SELECT * FROM `pics` WHERE IDpic = ?;");
        $req->execute(array($idpic));
        $data = $req->fetch();
        $db->commit();
    	try {
        	$db->beginTransaction();
       		$req = $db->prepare("SELECT LOGIN FROM `user` WHERE ID = ?;");
        	$req->execute(array($data['IDusr']));
        	$name = $req->fetch();
        	$db->commit();
        	?><t style="font-size: 22px; margin-left: 45%;">Une photo de :   </t><t style="font-weight: bolder; font-family: 'Pacifico', cursive; font-size: 34px;"><?php echo $name['LOGIN']; ?></t> <?php
    }
    catch (PDOException $e) 
    {
        $db->rollBack();
    	echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    }
    }
    catch (PDOException $e) 
    {
        $db->rollBack();
    	echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    }
?>