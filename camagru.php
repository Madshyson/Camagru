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
                    <tr style="border:3px solid black;">
                        <th>
                            <div class="videocanvas">
                                <video id="video"></video><br/>
                                <button class="cam-button" id="startbutton">Cam<br/>Yourself</button>
                            </div>
                        </th>
                        <th>
                            <table>
                                <?php include('func/DBsearchfilter.php') ?>
                            </table>
                        </th>
                        <th>
                            <div class="minigallerycanvas">
                                <canvas id="canvas"></canvas>
                            </div>
                        </th>
                    </tr>
                </table>
                 <script type="text/javascript" src="js/camscript.js"></script>
                <?php include("footer.html") ?>
        </body>
    </html>