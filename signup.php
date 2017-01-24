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
			<form action="func/DBsignup.php" method="post">
				<label for="pseudo">Login  </label></br>
				<input id="pseudo" type="text" name="pseudo" size="28"/></br></br>
				<label for="pseudo">Mail </label></br>
				<input id="mail" type="text" name="mail" size="28"/></br></br>
				<label for="pseudo">Password  </label></br>
				<input id="password" type="password" name="password" size="28"/></br></br>
				<label for="pseudo">Confirm Password </label></br>
				<input id="password2" type="password" name="password2" size="28"/></br></br>
				<input type="submit" name="submit" value="OK" class="button">
			</form>
			<form action="./index.php">
  			 	<input type="submit" value="Go Back to Signin" />
			</form>
			<?php
				if ($_SESSION['errorMsg']) {
					echo "<span class='errorMsg'>" . $_SESSION['errorMsg'] . "</span><br>";
				}
			?>
		</div>
		<?php include("footer.html") ?>
	</body>
</html>