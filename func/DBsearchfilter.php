<?php
    try 
    { 
        $db->beginTransaction();
        $req = $db->prepare("SELECT * FROM `img`;");
        $req->execute();
        while ($dataImg = $req->fetch())
        { 
            $prd = $dataImg['PRD_Img']; ?>
            <tr><img style="border: solid black; margin: 3px;" height="150px;" onclick="document.getElementById('filter').src='<?php echo $prd; ?>'; document.getElementById('uploadform').value='<?php echo $prd; ?>';" src="<?php echo $prd; ?>"></tr> 
            <?php
        }
    }
    catch (PDOException $e) 
    {
        $db->rollBack();
        echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    }
?>