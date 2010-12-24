<?php

	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}

	// Removes the peristent login cookies
	setcookie("QuotesMachine-PersistentLogin", null);
	setcookie("QuotesMachine-User", null);
	setcookie("QuotesMachine-Password", null);	

	// Redirects to login.php
	header("Location: system.login.php");

	// Destroys session
	session_destroy();
?>
