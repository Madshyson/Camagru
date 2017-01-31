<?php
    try
    {
        $db->beginTransaction();
        $req = $db->prepare("SELECT * FROM `likes` WHERE IDpic = ?;");
        $req->execute(array($idpic));
        $data = $req->rowCount();
        ?> <td> <?php echo $data;
        $db->commit();
    }
    catch (PDOException $e) 
    {
        $db->rollBack();
        echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    }
    try 
    {
        $db->beginTransaction();
        $req = $db->prepare("SELECT IDuser FROM `likes` WHERE IDpic = ? AND IDuser = ?;");
        $req->execute(array($idpic, $_SESSION['id_usr']));
        $data = $req->fetch();
        $db->commit();
    }   catch(PDOException $e)
    {
        $db->rollBack();
        echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    } 
?>