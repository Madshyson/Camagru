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
            <div class="ImgPrincipale">
                AU MILIEU AVEC DE LA PLACE POUR COMMENTER ET METTRE UN PLUS IL FAUT QUE LA SELECTION UPDATE $_SESSION ID_PIC
            </div>
            <div class="gall">
                 <?php include('./func/DBgallery.php') ?>
            </div>
            <?php include("footer.html") ?>
    </body>
</html>