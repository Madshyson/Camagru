<?php
    try 
    { 
        $db->beginTransaction();
        $req = $db->prepare("SELECT * FROM `img`;");
        $req->execute();
        while ($dataImg = $req->fetch())
        { 
            $prd = $dataImg['PRD_Img']; ?>
            <tr style="border: solid black;"><img height="150px;" src="<?php echo $dataImg['PRD_Img']?>"></tr>
            <?php
        }
    }
    catch (PDOException $e) 
    {
        $db->rollBack();
        echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    }
?>