<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Guest Book | View Entries</title>
</head>

<body>
	<h2>Curtis' Guest Book</h2>
	<h3>Previous Entries Viewer</h3>
	<?php
		if(isset($_GET['action'])){
			if((file_exists("GuestBook/guestEntries.txt")) && (filesize("GuestBook/guestEntries.txt") != 0)){
				$GuestArray = file("GuestBook/guestEntries.txt");
				switch($_GET['action']){
					case 'Remove Duplicates':
						$GuestArray = array_unique($GuestArray);
						$GuestArray = array_values($GuestArray);
						break;
					case 'Sort Ascending':
						sort($GuestArray);
						break;
					case 'Shuffle':
						shuffle($GuestArray);
						break;
				}
				if(count($GuestArray) > 0){
					$NewGuest = implode($GuestArray);
					$GuestStore = fopen("GuestBook/guestEntries.txt", "wb");
					if($GuestStore === false){
						echo "There was an error updating the guest file\n";
					}else{
						fwrite($GuestStore, $NewGuest);
						fclose($GuestStore);
					} // end innermost nested if
				}else{
					unlink("GuestBook/guestEntries.txt");
				} // end second level nested if
			} // end first level inner if
		} // end outer if
	
		if((!file_exists("GuestBook/guestEntries.txt")) || (filesize("GuestBook/guestEntries.txt") == 0)){
			echo "<p>There are no messages posted.</p>\n";
		}else{
			$GuestArray = file("GuestBook/guestEntries.txt");
			echo "<table style=\"background-color: lightgray;\" border=\"1\" width=\"100%\">\n";
			$Count = count($GuestArray);
			for($p = 0; $p < $Count; ++$p){
				$CurrentPost = explode("~", $GuestArray[$p]);
				echo "<tr>\n";
				echo "<td width=\"5%\" style=\"text-align: center; font-weight: bold;\">". ($p + 1) ."</td>\n";
				echo "<td width=\"95%\" style=\"padding-left: 20px; height: 50px;\"><span style=\"font-weight: bold;\">Name:</span> ". htmlentities($CurrentPost[0]) ."<br />\n";
				echo "<span style=\"font-weight: bold;\">e-mail:</span> ". htmlentities($CurrentPost[1]) ."</td>\n";
				echo "</tr>\n";
			} // end for
			echo "</table>\n";
		} // end if
	?>
	<p>
		<a href="GuestBookViewer.php?action=Sort%20Ascending">Sort Guests Alphabetically</a><br />
		<a href="GuestBookViewer.php?action=Remove%20Duplicates">Remove Duplicate Guests</a><br />
		<a href="GuestBookViewer.php?action=Shuffle">Randomize Guests</a><br />
	</p>
	<p><a href="GuestBookForm.php">Post your entry</a></p>
</body>
</html>