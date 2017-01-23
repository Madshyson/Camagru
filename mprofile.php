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
            <div class="login_input">
                <form action="./func/DBupdatepro.php" method="post">
                    <label for="mail">Change Mail  </label></br>
                    <input id="mail" type="text" name="mail" size="28"/></br></br>
                    <label for="pseudo">Change Pseudo </label></br>
                    <input id="pseudo" type="text" name="pseudo" size="28"/></br></br>
                    <label for="password">Change Password</label></br>
                    <input id="password" type="password" name="password" size="28"/></br></br>
                    <input type="submit" name="submit" value="OK" class="button">
                </form>
                <form action="./func/DBreinitialisermail.php" method="post">
                     <input type="submit" name="submit" value="Forgot Password?" class="button">
                </form>
                <?php
                if ($_SESSION['changeMsg']) {
                    echo "<span class='errorMsg'>" . $_SESSION['changeMsg'] . "</span><br>";
                }
            ?>
            </div>
            <?php include("footer.html") ?>
    </body>
</html>