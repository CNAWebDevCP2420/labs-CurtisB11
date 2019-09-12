<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Temperature Conversion</title>
</head>

<body>
	<?php
		$Fahrenheit = 0;
		while($Fahrenheit < 101){
			$DegreesCelsius = ($Fahrenheit - 32) * 5 / 9;
			echo $Fahrenheit ."&deg; Fahrenheit equals: ". round($DegreesCelsius, 1) ."&deg; Celsius.<br />";
			++$Fahrenheit;
		}
	?>
</body>
</html>