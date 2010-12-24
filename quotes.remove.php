<?php
	
	// Includes authorization routines
	include_once("libs/libraries.auth.php");

	// Includes initialization routines
	include_once("libs/libraries.init.php");	

	// Includes database routines
	include_once("libs/libraries.db.php");

	// Build quotes list
		
		// Gets from POST method
		if (is_array($_POST["id"])) {
			$quotes = $_POST["id"];
		}

		elseif ($_POST["id"]) {
			$quotes[] = $_POST["id"];
		}

		// Gets from GET method
		if ($_GET["id"]) {
			$quotes[] = $_GET["id"];
		}

	// Removes the required quotes

		// Sets first indicator
		$first = true;

		// Build body of query and assigns the first quote
		$query = "DELETE FROM quotes_machine WHERE id=" . $quotes[0];


		// Traverses through all quotes and joins the to the query
		for ($i = 1; $i < count($quotes); $i++) {
		
			// Joins the quote ID to query
			$query .= " OR id=" . $quotes[$i];
		}
			
		// Executes the query
		mysql_query($query);

	// Redirects back to list.php
	header("Location: quotes.list.php");
?>
