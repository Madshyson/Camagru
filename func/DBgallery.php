<?php
	try 
    { 
        $db->beginTransaction();
        $req = $db->prepare("SELECT * FROM `pics` ORDER BY IDpic DESC;");
        $req->execute();
        while ($dataImg = $req->fetch())
        { 
            $prd = $dataImg['PRD_Img']; ?>
            <tr style="margin: 20px;"><img style="border: solid black; width: 400px; height: 270px;" onclick="document.getElementById('imgGallery').src='<?php echo $prd; ?>';" height="150px;" src="<?php echo $prd ?>"></tr>
            <?php
        }
    }
    catch (PDOException $e) 
    {
        $db->rollBack();
        echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    }
?>