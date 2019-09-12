<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Rounding</title>
</head>

<body>
	<?php
		print "<p>Rounding numbers using method round()</p>";
		print "Rounding 5.3 to the nearest whole number will return a value of: ". round(5.3) ."<br />";
		print "Rounding 5.6 to the nearest whole number will return a value of: ". round(5.6) ."<br />";
		print "Rounding -5.3 to the nearest whole number will return a value of: ". round(-5.3) ."<br />";
		print "Rounding -5.6 to the nearest whole number will return a value of: ". round(-5.6) ."<br />";
		
		print "<br /><br /><p>Rounding numbers using method ceil()</p>";
		print "Rounding 5.3 to the nearest whole number will return a value of: ". ceil(5.3) ."<br />";
		print "Rounding 5.6 to the nearest whole number will return a value of: ". ceil(5.6) ."<br />";
		print "Rounding -5.3 to the nearest whole number will return a value of: ". ceil(-5.3) ."<br />";
		print "Rounding -5.6 to the nearest whole number will return a value of: ". ceil(-5.6) ."<br />";
		
		print "<br /><br /><p>Rounding numbers using method floor()</p>";
		print "Rounding 5.3 to the nearest whole number will return a value of: ". floor(5.3) ."<br />";
		print "Rounding 5.6 to the nearest whole number will return a value of: ". floor(5.6) ."<br />";
		print "Rounding -5.3 to the nearest whole number will return a value of: ". floor(-5.3) ."<br />";
		print "Rounding -5.6 to the nearest whole number will return a value of: ". floor(-5.6) ."<br />";
	?>
</body>
</html>