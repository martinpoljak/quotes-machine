<?php
	// Includes administration routines
	require_once("libs/libraries.admin.php");	

	// Includes database routines
	require_once("libs/libraries.db.php");		
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
	<head>
		<title>QuotesMachine Administration :: Listing</title>
	</head>
	<body>
	
		<a href="quotes.edit.php">add quote</a> <a href="system.logout.php">log out</a><br /><br />
		<p>
			<form method="post" action="quotes.remove.php">
	
				<input type="submit" value="Remove selected" /> <!--input type="submit" value="Delete all" /--><br /><br />
				<table cellspacing="0" cellpadding="2" width="60%" border="0" style="border: 1px solid black; border-bottom: 0;">
<?php
	// Gets quotes
	$result = mysql_query("SELECT * FROM quotes_machine ORDER BY author, body ASC", $db);

	// Sets the first indicator
	$first = true;

	// Writes data out
	while ($row = mysql_fetch_object($result)) {
?>
					<tr>
						<td valign="top" rowspan="2" style="background-color: #BBBBBB; border-bottom: 1px solid black;"><a name="<?php echo $row->id; ?>" /><input type="checkbox" name="id[]" value="<?php echo $row->id; ?>" /><a name="<?php echo $row->id; ?>" /></td>
						<td style="padding-left: 15px;"><b><?php echo $row->url ? '<a href="' . $row->url . ' ">' : null; ?><?php echo $row->author ? $row->author : "anonym"; ?><?php echo $row->url ? '</a>' : null; ?></b></td>
						<td rowspan="2" width="7%" align="center" style="background-color: white; border-bottom: 1px solid black; border-left: 1px solid black;">
							<a href="quotes.edit.php?id=<?php echo $row->id; ?>">edit</a><br />
							<a href="quotes.remove.php?id=<?php echo $row->id; ?>">remove</a>				
						</td>			
					</tr>
					<tr>
						<td style="padding-left: 15px; padding-bottom: 10px; border-bottom: 1px solid black;"><?php echo $row->body; ?></td>
					</tr>	
<?php
		$first = false;
	}
?>
				</table>
			</form>
		</p>

	</body>
</html>
