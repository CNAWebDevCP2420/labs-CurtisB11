<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Registered Bowlers List</title>
</head>

<body>
	<h1>Registered Bowlers</h1>
	<hr />
	<?php
		$NamesList = file("registeredBowlers.txt");
		$NamesFile = "registeredBowlers.txt";
		$permissions = fileperms($NamesFile);
		$permissions = decoct($permissions % 01000);
		echo "file permissions for $NamesFile: 0". $permissions ."<br />\n";
		
		if(file_put_contents($NamesFile, $NamesList) != 0){
			for($y = 0; $y < count($NamesList); ++$y){
				echo "<pre>";
				echo "Registered Bowler ". ($y + 1) .": ". $NamesList[$y];
				echo "</pre>";
			}
		}else{
			echo "<p>No one has yet signed up to bowl.</p>";
		}
	?>
	<p><a href="BowlingRegistration.html">Register Another Bowler</a></p>
</body>
</html>