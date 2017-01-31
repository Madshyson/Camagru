<?php
    require_once('./func/connectDb.php');
    if ($_SESSION['login'] == "")
    {
        $return = '<p>Vous ne pouvez pas accedez au site sans vous connecter ! Cliquez <a href="./index.php">ici</a>';
        echo $return;
        include("footer.html");
        die();
    }
    $idpic = $_GET['idpic'];
?>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css">
        <title>Camagru</title>
        </head>
        <body background="Ressources/bgGrey.png">
            <?php include("header.html");
            if($_GET['idpic'])
            { ?>
                <table class="tabgallery">
                    <tr>
                        <?php include("./func/DBdispname.php") ?>  
                    </tr>
                    <tr>
                        <td colspan="4">
                        <?php
                            if ($idpic)
                                { ?>
                               <img id="imgGallery" src="./img/<?php echo $data['PRD_pic'];?>" style="border: 1px solid white; width: 640px; height: 480px;">
                        <?php }
                        ?>
                        </td>
                    </tr>
                      <?php
                    if ($data['IDusr'] == $_SESSION['id_usr']) 
                    {
                    ?>
                    <td colspan="">
                       <img src="./Ressources/delete.png" width="40px" height="40px" onclick="document.location.href='./func/DBdeletepic.php?idpic=<?php echo $idpic;?>'">
                    </td>
                    <tr></tr>
                    <?php
                    }
                    include("./func/DBdisplikes.php");
                    if($data['IDuser'] != $_SESSION['id_usr'])
                    { ?>
                        <img src="./Ressources/greyT.png" onclick="document.location.href='./func/DBaddlike.php?idpic=<?php echo $idpic; ?>'" width="40px" height="40px"></td> 
                    <?php }
                    else { ?>
                        <img src="./Ressources/blueT.png" onclick="document.location.href='./func/DBdellike.php?idpic=<?php echo $idpic; ?>'" width="40px" height="40px"></td> 
                    <?php } ?>
                    <tr>
                        <td colspan="4">
                            <form action="func/DBaddcomment.php?idpic=<?php echo $idpic;?>&prdpic=<?php echo $prdpic;?>" method="post">
                                <textarea name="comment" cols="40" rows="5"></textarea>
                                <input type="submit" name="submit" value="Comment" class="button">
                            </form>
                        </td>
                    </tr>
                </table>
                    <?php
                    include("./func/DBdisocomm.php");  
                    }
            include("footer.html") ?>
            <div style="margin-bottom: 5vh;"></div>
    </body>
</html>