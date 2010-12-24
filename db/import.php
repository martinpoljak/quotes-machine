<?php
	// Sets the content type and encoding
	header("Content-Type: text/html; charset=utf-8");

	// Starts output buffering
	ob_start("ob_gzhandler");

	// Sets path to QueryMachine
	$qm_path = "../";

	// Includes the database routines
	include_once("../libs/libraries.db.php");

	// Reads the quotes table definitions file

		// Opens the file
		$file = fopen("quotes_machine.sql", "r");

		// Reads the data
		$quotes_machine_definition = fread($file, filesize("quotes_machine.sql"));
		
	// Reads the authors table definitions file

		// Opens the file
		$file = fopen("quotes_machine_authors.sql", "r");

		// Reads the data
		$quotes_machine_authors_definition = fread($file, filesize("quotes_machine_authors.sql"));
		
	// Includes them to database
	mysql_query($quotes_machine_definition, $db) or "quotes_machine.sql: " . die(mysql_error() . ".");
	mysql_query($quotes_machine_authors_definition, $db) or "quotes_machine_authors.sql: " . die(mysql_error() . ".");

	// Creates the .htaccess file
	$file = fopen(".htaccess", "w");

		// Denies accessing from all
		fwrite($file, "deny from all");

		// Closes the file
		fclose($file);
?>
OK
