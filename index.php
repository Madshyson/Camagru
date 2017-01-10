<?php session_start();?>
<html>
	<head>
		<title>Camagru</title>
		<link rel="stylesheet" href="css/style.css" type="text/css">
	</head>
	<body background="Ressources/Background.png">
		<?php
    		if(!$_SESSION)
        		$_SESSION['login'] = '';
   		?>
		<div class="login_input">
			<form action="login.php" method="post">
			<label for="login">E-Mail  </label></br>
			<input id="login" type="text" name="login" size="28"/></br></br>
			<label for="password">Password  </label></br>
			<input id="password" type="password" name="password" size="28"/></br></br>
			<input class="middle_button" ;" type="submit" name="submit" value="OK" class="button">
			</form>
			<p class="not_member">Not a Member ?</br><a href="signup.php">Sign up !</p>
		</div>
		<div class="footer">
                <P class="footer_text">&copy; mlavanan 2016&nbsp;&nbsp;&nbsp;<P/>
        </div>
	</body>
</html>