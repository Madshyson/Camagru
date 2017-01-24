<?php
require_once('./func/connectDb.php');
if ($_SESSION['login'] == "")
    {
        $return = '<p>Vous ne pouvez pas accedez au site sans vous connecter ! Cliquez <a href="./index.php">ici</a>';
        echo $return;
        include("footer.html");
        die();
    }
?>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css">
        <title>Camagru</title>
        </head>
        <body background="Ressources/bgGrey.png">
            <?php include("header.html") ?>
            <table class="tabgallery">
                <tr>
                    <td colspan="4">
                           <img id="imgGallery" src="Ressources/feela.png" style="border: 1px solid white;">
                    </td>
                </tr>
<?php
                if ($_SESSION['id_pic'])
                { ?>
                    <tr><td colspan="4"><form action="./func/DBdeletepic.php" method="post"><input type="submit" name="submit" value="delete" class="button"></form></td></tr>
<?php               
                }
                try
                {
                    $db->beginTransaction();
                    $req = $db->prepare("SELECT * FROM `likes` WHERE IDpic = ?;");
                    $req->execute(array($_SESSION['id_pic']));
                    $data = $req->fetch();
                     ?> <tr><td> <?php echo (count($data) - 1); ?> </td></tr> <?php
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
                    $req = $db->prepare("SELECT `com` FROM `comments` WHERE IDpic = ?;");
                    $req->execute(array($_SESSION['id_pic']));
                    $data = $req->fetch();
                    $db->commit();
                    while ($data = $req->fetch())
                    { ?>
                        <div style="width: 25%; margin-left: 35%;"> <?php echo $data['com'] - 1; ?> </div>
                        <hr align="center" width="80%">
                    <?php }
                    }
                    catch (PDOException $e) 
                    {
                        $db->rollBack();
                        echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
                    } ?>
                <tr><td><br><br></td></tr>
                <tr>
                    <?php include('./func/DBgallery.php') ?>
                 </tr>
            </table>
            <?php include("footer.html") ?>
    </body>
</html>