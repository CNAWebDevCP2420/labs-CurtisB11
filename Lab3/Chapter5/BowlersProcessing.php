<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Processing</title>
</head>

<body>
	<?php
		if((empty($_POST['first_name'])) || (empty($_POST['last_name'])) || (empty($_POST['age'])) || (empty($_POST['bowling_average']))){
			echo "<h2>Bowling Registration Form Error</h2>";
			echo "<p>All form fields are required to register.<br />Click your browser's Back button, or the link below, to return to the Bowling Registration form.</p>\n";
			echo "<br />";
			echo "<p><a href=\"BowlingRegistration.html\">Register for Bowling Form</a></p>";
			echo "<p><a href=\"BowlingViewRegistrationList.php\">View Registered Bowlers List</a></p>";
		}else{
			$FirstName = addslashes($_POST['first_name']);
			$LastName = addslashes($_POST['last_name']);
			$BowlersAge = addslashes($_POST['age']);
			$BowlersAverage = addslashes($_POST['bowling_average']);
			$RegisteredBowlers = fopen("registeredBowlers.txt", "ab");
			chmod("registeredBowlers.txt", 0666);
			if(is_writeable("registeredBowlers.txt")){
				if(fwrite($RegisteredBowlers, $LastName .",". $FirstName .",". $BowlersAge .",". $BowlersAverage ."\n")){
					echo "<p>Thank you for registering in our bowling tournament!</p>\n";
				}else{
					"<p>Cannot add your name to the bowling tournament list.</p>\n";
				}
			}else{
				echo "<p>Cannot write to the file.</p>\n";
			}
			fclose($RegisteredBowlers);
		}
	?>
</body>
</html>