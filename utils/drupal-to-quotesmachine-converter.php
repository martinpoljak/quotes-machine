<?php
	// Sets the content type and encoding
	header("Content-Type: text/html; charset=utf-8");

	// Starts output buffering
	ob_start("ob_gzhandler");
	
	// Connects to server



/* ##############################################################################

   CONFIGURE HERE:

   * server
   * username
   * password	 */
   
	mysql_connect("localhost", "root", "");

/* ############################################################################## */




	// Sets correct encodings
	@mysql_query("SET NAMES 'utf8'");
	@mysql_query("SET CHARACTER SET utf8");




/* ##############################################################################

   CONFIGURE HERE:

   * source database	 */

	mysql_select_db("drupal_quotes");

/* ############################################################################## */	




	// Obtains all quotes list
	$result = mysql_query("SELECT nid, author FROM quotes");

		// Traverses through all quotes and saves them to its own data structure
		while ($row = mysql_fetch_object($result)) {
			// Saves data
			$quotes[$row->nid]["nid"] = $row->nid;
			$quotes[$row->nid]["author"] = $row->author;
		}
	
	// Obtains quotes body
	$result = mysql_query("SELECT nid, body FROM node WHERE type = 'quotes'");	

		// Traverses through all queries and saves their body to its own data structure
		while ($row = mysql_fetch_object($result)) {
			// Saves data
			$quotes[$row->nid]["body"] = $row->body;
		}

	// Writes all out
	/*
	foreach($quotes as $quote) {
		echo "Autor: ", $quote["author"], "<br/>";
		echo "Body: ", $quote["body"], "<br/>";		
		echo "<hr/>";
	}
	*/



/* ##############################################################################

  CONFIGURE HERE:

   * target database	 */
   
	mysql_select_db("martinkozak_net");

/* ############################################################################## */




	// Writes all to new database structure
	foreach($quotes as $quote) {
		mysql_query("INSERT INTO quotes_machine (author, body) VALUES ('" . mysql_real_escape_string($quote["author"]) . "', '" . mysql_real_escape_string($quote["body"]) . "')") or die(mysql_error() . ".");
	}

	// Writes a message about necessary of add URLs
	echo "DONE! There will be necessary to add URLs to Your quotes.";

?>
