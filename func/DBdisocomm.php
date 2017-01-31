<?php 
$idpic = $_GET['idpic'];
$prdpic = $_GET['prdpic'];
 try {
        $db->beginTransaction();
        $req = $db->prepare("SELECT * FROM `comments` WHERE IDpic = ?;");
        $req->execute(array($idpic));
        $data = $req->fetchAll();
        $db->commit();
    	foreach ($data as $value)
        { 
    		try 
    		{
    			$db->beginTransaction();
        		$req = $db->prepare("SELECT LOGIN FROM `user` WHERE ID = ?;");
       			$req->execute(array($value['IDuser']));
       			$name = $req->fetch();
        		$db->commit();
    		} 
    		 catch (PDOException $e) 
    		{
        		$db->rollBack();
    			echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    		}
    		?>
        	<div style="margin-left: 20%; width: 25%;text-align: left;"><p style="font-weight: bold"> <?php echo $name['LOGIN'].":";?></p>
        	<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$value['com']; ?></div>
        	<hr width="60%">
        	<br/>
    <?php }
    }
    catch (PDOException $e) 
    {
        $db->rollBack();
    	echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    }

?>