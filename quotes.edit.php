<?php
	// Includes administration routines
	require_once("libs/libraries.admin.php");	

	// If editation mode is required
	if (!$_POST["q"]) {

		// Includes database routines
		require_once("libs/libraries.db.php");	

		// If editation is required, loads appropriate quote
		if ($_GET["id"]) {
	
			// Queries for the quote
			$result = mysql_query("SELECT author, url, body FROM quotes_machine WHERE id=" . $_GET["id"], $db);

				// Fetches the result
				$quote = mysql_fetch_object($result);
		}
		
		// Queries for the predefined authors
		$authors = mysql_query("SELECT id, name, url FROM quotes_machine_authors ORDER BY name ASC", $db);	
	}

	// If saved mode is required
	else {
		// Includes database routines
		require_once("libs/libraries.db.php");
			
		// If editation data has been received, update appropriate quote
		if ($_GET["id"]) {

			// Sends query
			mysql_query("UPDATE quotes_machine SET author='" . $_POST["author"] . "', url='" . $_POST["url"] . "', body='" . $_POST["body"] . "' WHERE id=" . $_GET["id"]);
		}

		// In otherwise inserts new
		else { 
			// Sends query
			mysql_query("INSERT INTO quotes_machine (author, body, url) VALUES ('" . $_POST["author"] . "', '" . $_POST["body"] . "', '" . $_POST["url"] . "')");
		}	

		// If saving of the author is required and he doesn't exists already, saves him
		if ($_POST["save_new_author"] and !mysql_num_rows(mysql_query("SELECT id FROM quotes_machine_authors WHERE name='" . $_POST["author"] . "' AND url='" . $_POST["url"] . "'"))) {
		
			// Sends query
			mysql_query("INSERT INTO quotes_machine_authors (name, url) VALUES ('" . $_POST["author"] . "', '" . $_POST["url"] . "')");
		}	

		// Redirects to list
		header("Location: quotes.list.php" . ($_GET["id"] ? "#" . $_GET["id"] : null));
			die();

	}			

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
	<head>
		<title>QuotesMachine Administration :: Listing</title>
	</head>
	<body>
	
		<a href="quotes.list.php">back to list</a><?php echo $_GET["id"] ? " <a href=\"quotes.remove.php?id=" . $_GET["id"] . "\">remove it</a>" : null; ?><br /><br />
		<p>
			<form method="post" action="authors.remove.php?g=<?php echo(rawurlencode("quotes.edit.php?id=" . $_GET["id"])) ?>" name="predefined_authors">
				Predefined authors:&nbsp;&nbsp;&nbsp;<select name="predefined_author" onchange="processPredefinedAuthor(this.value);">
				<option></option>
				<?php
					// Writes out all available authors
					while ($author = @mysql_fetch_object($authors)) {
						echo "<option value=\"", $author->id, "|", $author->name, "|", $author->url, "\">", $author->name, $author->url ? " (" .  $author->url . ")" : "", "&nbsp;&nbsp;&nbsp;</option>";
					}
				?>
				</select>&nbsp;&nbsp;&nbsp;
				<input type="submit" value="Remove author" />
				<input type="hidden" name="id" />
			</form>
			<script type="text/javascript">
				<!--
					function processPredefinedAuthor(data_string) {
			
						// Selects URL according to author and assigns them to the appropriate fields
						with (document.quote_edit) {

							// Extracts data from a data string
							data = new String(data_string);

								// Matches it with regular expression
								data_records = data.match(/([^|]*)\|([^|]*)\|(.*)/i);
					
							// Assigns them
							author.value = data_records[2];
							url.value = data_records[3];
						}
		
						document.predefined_authors.id.value = data_records[1];
					}
				-->
			</script>
			<hr />	
			<form method="post" action="quotes.edit.php<?php echo $_GET["id"] ? "?id=" . $_GET["id"]  : null; ?>" name="quote_edit">		
				Author: <input name="author" size="50"<?php echo $quote->author ? "value=\"" . $quote->author . "\"" : null; ?> /><br />
				<abbr title="Uniform Resource Locator">URL</abbr>: <input name="url" size="52"<?php echo $quote->url ? "value=\"" . $quote->url . "\"" : null; ?> /><br /><br />
				<input name="save_new_author" type="checkbox" /> save as the new predefined author
				<hr />
				<textarea name="body" cols="60" rows="5"/><?php echo $quote->body; ?></textarea><br /><br />
				<input type="submit" value="Save it" name="q" />
			</form>
		</p>

	</body>
</html>	
