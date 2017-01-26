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
                           <img id="imgGallery" src="<?php echo $_SESSION['img_prd']; ?>" style="border: 1px solid white;">
                    </td>
                </tr>
<?php
                try
                {
                    $db->beginTransaction();
                    $req = $db->prepare("SELECT IDpic FROM `likes` WHERE IDpic = ?;");
                    $req->execute(array($_SESSION['id_pic']));
                    $data = $req->fetch();
                     ?> <tr><td> <?php echo (count($data) - 1); 
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
                    $req->execute(array($_POST['login'], $mdp));
                    $data = $req->fetch();
                    $db->commit();
                }   catch(PDOException $e)
                {
                    $db->rollBack();
                    echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
                } 
                if($data['IDuser'] == $_SESSION['id_usr'])
                { ?>
                    </td><td><img src="./Ressources/greyT.png" onclick="document.location.href='./func/DBaddlike.php'" width="40px" height="40px"></td></tr> 
                <?php }
                else { ?>
                    </td><td><img src="./Ressources/blueT.png" width="40px" height="40px"></td></tr> 
                <?php } ?>
                <tr>
                    <td colspan="4">
                        <form action="func/DBaddcomment.php" method="post">
                            <textarea name="comment" cols="40" rows="5"></textarea>
                    </td>
                </tr>
                <tr><td colspan="4"> <?php $_SESSION['submitMsg'] ?></td></tr>
                    <td colspan="4">
                            <input type="submit" name="submit" value="Comment" class="button">
                        </form>
                    </td>
                </tr>
<?php
                try 
                {
                    $db->beginTransaction();
                    $req = $db->prepare("SELECT `com` FROM `comments` WHERE IDpic = ?;");
                    $req->execute(array($_SESSION['id_pic']));
                    $data = $req->fetch();
                    $db->commit();
                    while ($data = $req->fetch())
                    { ?>
                        <div style="width: 25%; margin-left: 35%;"> <?php echo $data['com']; ?> </div>
                        <hr align="center" width="80%">
                    <?php }
                    }
                    catch (PDOException $e) 
                    {
                        $db->rollBack();
                        echo 'Connexion échouée : ' . $e->getMessage() . '<br/>';
                    } ?>
                <tr><td><br><br></td></tr>
               <table style="margin-left: 20%; border-spacing: 5px;">
                    <?php include('./func/DBgallery.php') ?>
                </table>
            </table>
            <?php include("footer.html") ?>
    </body>
</html>