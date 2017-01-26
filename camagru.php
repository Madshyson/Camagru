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
                            <div class="videocanvas" id="pic">
                                <video style="position: relative;" id="video"></video> 
                                <img alt="" id='filter' style="position : absolute; left: -10px; top: 200px; width: 760px; height: 500px;" src="Ressources/feela.png">
                                <button class="cam-button" id="startbutton">Cam<br/>Yourself</button>
                                <div style="display:none;"><canvas id="canvas"></canvas></div>
                                <form action="./func/DBImportimg.php">
                                    <input id="file" type="file" name="img[]"/>
                                    <br/>
                                    <input type="button" name="upload" value="Upload Img">
                                </form>
                                <br/>
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
                                <photo></photo>
                            </div>
                        </th>
                    </tr>
                </table>
                <script type="text/javascript" src="js/camscript.js"></script>
                <?php include("footer.html") ?>
        </body>
    </html>