<?php
    $messagesParPage = 3;
    try 
    { 
        $db->beginTransaction();
        $req = $db->prepare("SELECT * FROM `pics` WHERE IDusr = :usr ORDER BY IDpic DESC");
        $req->bindParam(':usr', $_SESSION['id_usr'], PDO::PARAM_INT);
        $req->execute();
        $data = $req->rowCount();
        $nombreDePages = ($data / $messagesParPage);
         if (($data % $messagesParPage) == 0) {
            $nombreDePages = ($data / $messagesParPage);
        }
        else
        {
            $nombreDePages = ($data / $messagesParPage) + 1;
        }
        $db->commit();
        if(isset($_GET['page'])) 
        {
            $pageActuelle=intval($_GET['page']);
            if($pageActuelle>$nombreDePages) 
            {
                $pageActuelle=$nombreDePages;
            }
        }
        else 
        {
            $pageActuelle=1;
        }
    }
    catch (PDOException $e) 
    {
        $db->rollBack();
        echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    }
    try 
    {
        $premiereEntree=($pageActuelle-1)*$messagesParPage;
        $db->beginTransaction();
        $req = $db->prepare("SELECT * FROM `pics` WHERE IDusr = :usr ORDER BY IDpic DESC LIMIT :premiereEntree, :messagesParPage;");
        $req->bindParam(':usr', $_SESSION['id_usr'], PDO::PARAM_INT);
        $req->bindParam(':premiereEntree',  $premiereEntree, PDO::PARAM_INT);
        $req->bindParam(':messagesParPage', $messagesParPage, PDO::PARAM_INT);
        $req->execute();
        while ($dataImg = $req->fetch())
        {
            $prd = $dataImg['PRD_pic'];
            $id = $dataImg['IDpic']; ?>
            <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                     <td>  <div style="margin: 20px;"><a href="pic.php?idpic=<?php echo $id;?>"><img style="border: solid black; width: 320px; height: 240px;" height="150px;" src="<?php echo "img/".$prd ?>"></div></td>
                </tr>
            </table><br /><br />
        <?php
        }
    }
    catch (PDOException $e) 
    {
        $db->rollBack();
        echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
    } ?>
    <p align="center">Page :
    <?php 
        for($i=1; $i<=$nombreDePages; $i++) 
        {
            if($i==$pageActuelle)
            {
                echo ' [ '.$i.' ] '; 
            }  
            else
            { ?>
                <a href="mpics.php?page=<?php echo $i; ?>"> <?php echo $i; ?> </a>  <?php
            }
        } ?>
        </p>