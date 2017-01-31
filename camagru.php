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
                <table style="width:90%; margin:2%">
                    <tr>
                        <th>
                            <div class="videocanvas" id="pic">
                                <video id="video"></video> 
                                <img alt="" id='filter' src="Ressources/feela.png"><br/>
                                <button class="cam-button" id="startbutton">Cam<br/>Yourself</button>
                                <div style="display:none;"><canvas id="canvas"></canvas></div>
                                <form action="./func/DBsetupimg.php" method="post" enctype="multipart/form-data">
                                    Select image to upload: <br>
                                    <input type="file" name="fileToUpload" id="fileToUpload"> <br/>
                                    <input id="uploadform" name="filter" type="text" value="./Ressources/feela.png" style="display: none;">
                                    <input type="submit" value="Upload Image" name="submit"> <br/>
                                </form>
                                <br/>
                                <?php if($_SESSION["typeerror"]) {echo $_SESSION["typeerror"];}?>
                            </div>
                        </th>
                        <th>
                            <table>
                                <?php include('func/DBsearchfilter.php') ?>
                            </table>
                        </th>
                        <th>
                            <div class="minigallerycanvas">
                                <div><img src="<?php echo $_SESSION['img_prd'] ?>"></div>
                            </div>
                        </th>
                    </tr>
                </table>
                <script type="text/javascript" src="js/camscript.js"></script>
                <?php include("footer.html") ?>
        </body>
    </html>