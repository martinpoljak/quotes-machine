<?php	
	// Calls the QuotesMachine executive
	QuotesMachine();

	function QuotesMachine() {

		global $qm_quote, $qm_path;

		// Checks if $qm_path is set, if not, assigns the default
		if(!$qm_path) {

			// Sets the default path
			$qm_path = "./quotes-machine/";
		}
	
		// Includes database routines
		require_once($qm_path . "libs/libraries.db.php");

		// Selects all quotes in database for obtaining the quotes count
		$result = mysql_query("SELECT id FROM quotes_machine", $db);

		// Obtains the rows count
		$count = mysql_num_rows($result);

		// Obtains the quote number
		$number = isset($_COOKIE["QuotesMachine-LastQuote"]) ? $_COOKIE["QuotesMachine-LastQuote"] : null;

			// Checks if last quote number is lower than quote count
			if ($number === null or $number >= $count) {

				// Resets the quote number
				$number = 0;

			}

			else {
				// Increases the quote number
				$number++; 
			}

		// Selets the appropriate quote from database
		$result = mysql_query("SELECT author, body, url FROM quotes_machine LIMIT " . $number . ", 1", $db);

		// Fetches the quote data
		$qm_quote = mysql_fetch_object($result);

		// Saves the new last quote
		setcookie("QuotesMachine-LastQuote", $number, time() + 60 * 60 * 24 * 365);
	}

?>
<?php /*
<div id="quotes-machine">
	<div id="quotes-machine-body"><?php echo $qm_quote->body; ?></div>
	<div id="quotes-machine-url"><?php echo $qm_quote->url ? "<a href=\"" . $qm_quote->url . "\" title=\"" . ($qm_quote->author ? $qm_quote->author : "Anonym") . "\">"  : null; ?><?php echo $qm_quote->author ? $qm_quote->author : "anonym"; ?><?php echo $qm_quote->url ? "</a>" : null; ?></div>
</div> */ ?>
