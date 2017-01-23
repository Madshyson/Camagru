<?php
	try 
    { 
        $db->beginTransaction();
        $req = $db->prepare("SELECT * FROM `pics`;");
        $req->execute();
        while ($dataImg = $req->fetch())
        { 
            $prd = $dataImg['PRD_Img']; ?>
            <img style="border: solid black;" height="150px;" src="<?php echo $prd ?>">
            <?php
        }
    }
    catch (PDOException $e) 
    {
        $db->rollBack();
        echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    }
?>