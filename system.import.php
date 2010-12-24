<?php

	header("Content-Type: text/plain; charset=utf-8");	

	function writeout($data) {
		echo $data;
	}
	


	// Includes the configuration
	require_once("includes.config.php");

	// Initializes
	// (if import is available)
	
	if($param["import"] === True)
	{
	
		require_once("libs/libraries.db.php");	
		$method = $_GET["format"];	

		
		if($method and $_GET["source"])
		{
			// Loads data
			$data = file_get_contents($_GET["source"]);

			if($method == "json")
			{ $data = json_decode($data, True); }
			elseif($method == "serialize")
			{ $data = unserialize($data); }

			// Inserts them to the database
			if(is_object($data))
			{
				// AUTHORS
				foreach($data->authors as $row)
				{ mysql_query("INSERT INTO quotes_machine_authors (name, url) VALUES ('" . $row->name . "', '" . $row->url . "')"); }

				// QUOTES
				foreach($data->quotes as $row)
				{ mysql_query("INSERT INTO quotes_machine (author, body, url) VALUES ('" . $row->author . "', '" . $row->body . "', '" . $row->url . "')"); }

				writeout("OK");
			}

			else
			{
				writeout("An error occured. Dump of the obtained data follows:\n\n");
				var_dump($data);
			}
		}

		else
		{
			writeout("##################################################\n");
			writeout("## QuotesMachine Import Script                   #\n");
			writeout("##################################################\n");

			writeout("\n");		
			writeout("There are two formats available for importing:\n");
			writeout("	* \"json\" -- it uses the JSON format\n");
			writeout("	* \"serialize\" -- it uses output of PHP serialization\n");
			writeout("\n");
			writeout("You must specify it by the 'format' parameter.\n");
			writeout("\n");		
			writeout("Source must be specified by the 'source' parameter. It determines in\n");
			writeout("fact the file for import, so if they are allowed, you can use HTTP and\n");
			writeout("FTP handlers too. Basepath is filepath of the script in the server.\n");
			writeout("\n");
			writeout("It expects data compatible with output of 'system.export.php' script.\n");
			writeout("\n");		
			writeout("Importing can be disallowed by setting the 'import' parameter in\n");
			writeout("the configuration file out of True.\n");
		}
	}

	else
	{ writeout("Importing is disallowed in configuration file.\n"); }
	
?>
