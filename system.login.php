<?php
	// Includes initialization routines
	include_once("libs/libraries.init.php");

	// Starts the session

		// Sets the session timeout (30 minutes)
		session_set_cookie_params(time() + (60 * 30));

		// Starts it
		session_start();
	
	// If login informations received or session is already active, logs in and redirects to list.php
	if ($_POST["q"] == "Log in" or $_SESSION["active"] or $_COOKIE["QuotesMachine-PersistentLogin"]) {

		if(($param["administrator"][$_POST["user"]] == $_POST["password"] and $_POST["user"]) or $_SESSION["active"] or ($param["administrator"][$_COOKIE["QuotesMachine-User"]] == $_COOKIE["QuotesMachine-Password"] and $_COOKIE["QuotesMachine-PersistentLogin"])) {

			// Marks session as active
			$_SESSION["active"] = true;

			// If persistent login is required, sets appropriate cookies
			if ($_POST["persistent"] == "on") {
			
				// Computes the cookie expiration
				$expiration = time() + (60 * 60 * 24 * 365);
			
				// Sets them
				setcookie("QuotesMachine-PersistentLogin", true, $expiration);
				setcookie("QuotesMachine-User", $_POST["user"], $expiration);
				setcookie("QuotesMachine-Password", $_POST["password"], $expiration);
			}

			// Redirects to required path or list.php
			header("Location: " . ($_GET["g"] ? $_GET["g"] : "quotes.list.php"));
				die();			
		}
		
		else {
			$message = "Invalid password or username.";
		}
	}
			
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
	<head>
		<title>QuotesMachine Administration :: Login</title>
	</head>
	<body>
	
		<h1>Administration</h1>
		<form method="post" action="system.login.php">
			Username: <input name="user" /><br />
			Password: <input name="password" type="password" /><br /><br />
			<small><input name="persistent" type="checkbox" />&nbsp;&nbsp;persistent login</small><br /><br />
			<input name="q" type="submit" value="Log in "/><br />
			<?php echo $message ? "<p style=\"color: red;\">" . $message . "</p>" : ""; ?>
		</form>
	</body>
</html>
