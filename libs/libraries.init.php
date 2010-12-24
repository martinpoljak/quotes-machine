<?php
	// Includes setings
	require_once(($qm_path ? $qm_path : ($include_root ? $include_root : null)) . "includes.config.php");

	// Sets the content type and encoding
	header("Content-Type: text/html; charset=utf-8");
	header("Content-Style-Type: text/css");	
	header("Content-Script-Type: text/javascript");		

	// Starts output buffering
	@ob_start("ob_gzhandler");
?>
