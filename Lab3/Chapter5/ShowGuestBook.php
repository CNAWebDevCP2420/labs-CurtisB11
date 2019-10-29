<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Guest Book View Postings</title>
</head>

<body>
	<h1>Guest Book Postings List:</h1>
	<?php
		
		echo "<hr />\n";
		
		echo "<pre>";
		echo readfile("guestbook.txt");
		echo "</pre>";
		
		echo "<hr />\n";
		
		// The code below shows a variation on the code above. It displays the same guestbook entries with some basic formatting done on the data.
		$NamesList = file("guestbook.txt");
		$NamesFile = "guestbook.txt";
		
		if(file_put_contents($NamesFile, $NamesList) != 0){
			echo "<br /><br />";
			echo "<table style=\"background-color: lightgray;\" border=\"1\" width=\"100%\">\n";
			for($y = 0; $y < count($NamesList); ++$y){
				echo "<tr>\n";
				echo "<pre>";
				echo "<td style=\"width: 13%; height: 50px; padding-left: 20px;\">Signatory ". ($y + 1) ." Name: </td><td style=\"width: 87%; height: 50px; padding-left: 20px;\">". $NamesList[$y] ."</td>";
				echo "</pre>";
				echo "\n</tr>\n";
			}
			echo "</table>";
		}else{
			echo "<p>No one has yet signed the guest book.</p>";
		}
	?>
</body>
</html>