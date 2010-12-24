<?php	
 
	// Starts the session

		// Sets the session timeout (30 minutes)
		session_set_cookie_params(time() + (60 * 30));

		// Starts it
		session_start();

	// If session isn't active, redirects to login screen
	if(!$_SESSION["active"]) {

		// If it is a persistent cookie access
		if ($_COOKIE["QuotesMachine-PersistentLogin"]) {

			// Login redirection
			$redirection = $_SERVER["PHP_SELF"];
		}
		
		// Redirects to login.php
		header("Location: " . ($include_root ? $include_root : null) .  "system.login.php" . ($redirection ? "?g=" . rawurlencode($redirection) : null));
			die();
	}

	// If session is active and persistent login set, refreshes its cookies
	elseif ($_SESSION["active"] and $_COOKIE["QuotesMachine-PersistentLogin"]) {
	
		// Computes the cookie expiration
		$expiration = time() + (60 * 60 * 24 * 365);
			
		// Sets them
		setcookie("QuotesMachine-PersistentLogin", true, $expiration);
		setcookie("QuotesMachine-User", $_COOKIE["QuotesMachine-User"], $expiration);
		setcookie("QuotesMachine-Password", $_COOKIE["QuotesMachine-Password"], $expiration);	
	}
?>
