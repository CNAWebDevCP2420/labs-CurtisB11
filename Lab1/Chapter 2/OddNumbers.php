<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Odd Numbers</title>
</head>

<body>
	<?php
		$n = 0;
		echo "<br />A list of odd numbers between 1 and 100:<br />";
		while($n < 101){
			if($n % 2 !== 0){
				echo $n ."<br />";
			}
			++$n;
		}
	?>
</body>
</html>