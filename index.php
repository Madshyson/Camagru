<?php
    require_once('./func/connectDb.php');
?>
<html>
	<head>
		<title>Camagru</title>
		<link rel="stylesheet" href="css/style.css" type="text/css">
	</head>
	<body background="Ressources/bgGrey.png">
		<div class="login_input">
			<form action="func/DBlogin.php" method="post">
			<label for="login">Login : </label></br>
			<input id="login" type="text" name="login" size="28"/></br></br>
			<label for="password">Password : </label></br>
			<input id="password" type="password" name="password" size="28"/></br></br>
			<input class="middle_button" ;" type="submit" name="submit" value="OK" class="button">
			</form>
			<p class="not_member">Not a Member ?</br>
			<form action="signup.php">
   				 <input type="submit" value="Sign up !" />
			</form>
			<?php
				if ($_SESSION['sessionMsg']) {
					echo "<span class='errorMsg'>" . $_SESSION['sessionMsg'] . "</span><br><br>";
				}
			?>
		</div>
		<?php include("footer.html") ?>
	</body>
</html>