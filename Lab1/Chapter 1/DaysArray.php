<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Days of the Week</title>
</head>

<body>
	<?php
		$Days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
		echo "<p>The days of the week in English are:</p>";
		for($d = 0; $d < count($Days); ++$d){
			echo $Days[$d] ."&nbsp;&nbsp;";
		}
		$Days[0] = "Dimanche";
		$Days[1] = "Lundi";
		$Days[2] = "Mardi";
		$Days[3] = "Mercredi";
		$Days[4] = "Jeudi";
		$Days[5] = "Vendredi";
		$Days[6] = "Samedi";
		echo "<br /><br /><p>The days of the week in French are:</p>";
		for($d = 0; $d < count($Days); ++$d){
			echo $Days[$d] ."&nbsp;&nbsp;";
		}
	?>
</body>
</html>