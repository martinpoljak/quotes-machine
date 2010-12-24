<?php
	$method = $_GET["method"];

	function writeout($data) {
		echo $data;
	}

	header("Content-Type: text/plain; charset=utf-8");	


	// Includes the configuration
	require_once("includes.config.php");
	require_once("libs/libraries.db.php");	

	if($method == "json" or $method == "serialize")
	{
		// QUERIES
		
			// Queries for content
			$result = mysql_query("SELECT id, author, body, url FROM quotes_machine");

			// Traverses through all results
			while ($row = mysql_fetch_array($result)) {
				$data_quotes[] = array(
					"id" => $row["id"],
					"author" => $row["author"],
					"body" => $row["body"],
					"url" => $row["url"],
				);
			}
				

		// AUTHORS

			// Queries for content
			$result = mysql_query("SELECT id, name, url FROM quotes_machine_authors");

			// Traverses through all results
			while ($row = mysql_fetch_array($result)) {
				$data_authors[] = array(
					"id" => $row["id"],
					"name" => $row["name"],
					"url" => $row["url"],
				);
			}

		// DATA
		$data = array(
			"authors" => $data_authors,
			"quotes" => $data_quotes
		);


		if($method == "serialize")
		{ $result = serialize($data); }
		elseif($method == "json")
		{ $result = json_encode($data); }

		writeout($result);
	}
	
	elseif($method == "proprietary")
	{

		// Writes out the header
		writeout("##################################################\n");
		writeout("## Simple Database Backup                        #\n");
		writeout("##################################################\n");		
		writeout("# Encoding: UTF-8                                #\n");		
		writeout("# Date: " . date("Y-m-d") . "                               #\n");
		writeout("# Generator: QuotesMachine 1.1                   #\n");
		writeout("##################################################\n");
		writeout("\n");

		// Writes out the quotes table
		writeout("quotes_machine\n");
		writeout("id|author|body|url\n");
		writeout("plain|base64|base64|base64\n");	
	
			// Queries for content
			$result = mysql_query("SELECT id, author, body, url FROM quotes_machine");

			// Traverses through all results
			while ($row = mysql_fetch_object($result)) {
				writeout($row->id . "|" . base64_encode($row->author) . "|" . base64_encode($row->body) . "|" . base64_encode($row->url) . "\n");
			}
		// Writes out the separator
		writeout("---\n");
	
		// Writes out the authors table
		writeout("quotes_machine_authors\n");
		writeout("id|name|url\n");
		writeout("plain|base64|base64\n");		
	
			// Queries for content
			$result = mysql_query("SELECT id, name, url FROM quotes_machine_authors");

			// Traverses through all results
			while ($row = mysql_fetch_object($result)) {
				writeout($row->id . "|" . base64_encode($row->name) . "|" . base64_encode($row->url) . "\n");
			}
	}

	else
	{
		writeout("##################################################\n");
		writeout("## QuotesMachine Export Script                   #\n");
		writeout("##################################################\n");

		writeout("\n");		
		writeout("There are three methods available for exporting:\n");
		writeout("	* \"json\" -- the most compatible and progressive method which uses the JSON format\n");
		writeout("	* \"serialize\" -- this method dumps PHP serialized array (with the same structure as above JSON method)\n");
		writeout("	* \"proprietary\" -- it uses its own proprietary format, fields separed by '|' and encoded by base64\n");
		writeout("\n");
		writeout("You can specify it by the 'method' parameter.\n");
	}
	
?>
