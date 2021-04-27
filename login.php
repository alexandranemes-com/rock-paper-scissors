<?php 
	$salt = "XyZzy12*_";
	$stored_hash = "1a52e17fa899cf40fb04cfc42e6352f1";
	$logged_in = false;

	// if cancel button is clicked then return to index.php
	if (isset($_POST["cancel"])) {
		header("Location: index.php");
	}

	if (isset($_POST["who"]) && isset($_POST["pass"])) {

		if($_POST["who"] == "" || $_POST["pass"] == "") {

			$logged_in = "User name and password are required";

		} else {
			$submitted_password_salted = $salt.htmlentities($_POST["pass"]);
			$md5 = hash("MD5", $submitted_password_salted);
			
			// check password
			if ( $md5 == $stored_hash ) {
				header("Location: game.php?name=".urlencode($_POST["who"]));
			} else {
				$logged_in = "Incorrect password";
			}
		} 

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Alexandra Nemes RPS f68f71e0</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<div class="container">
		<h1 class="title">Please Log In</h1>
		<p class="error"><?php echo htmlentities($logged_in); ?></p>
		<form class="form" method="POST">
			<label for="nam">User Name</label>
			<input type="text" name="who" id="nam" /><br/>
			<label for="pass-id">Password</label>
			<input type="password" name="pass" id="pass-id" /><br/>
			<input type="submit" value="Log In">
			<input type="submit" value="Cancel" name="cancel">
		</form>
	</div>	
</body>
</html>