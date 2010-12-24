<?php
	// Includes setings
	require_once(($qm_path ? $qm_path : ($include_root ? $include_root : null)) . "includes.config.php");

	// Opens connection to database server
	$db = mysql_connect($param["database-server"], $param["database-user"], $param["database-password"]);

	// Sets correct encodings
	@mysql_query("SET NAMES 'utf8'", $db);
	@mysql_query("SET CHARACTER SET utf8", $db);
	
	// Selects the database
	mysql_select_db($param["database-name"], $db);
?>
