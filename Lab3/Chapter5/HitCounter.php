<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hit Counter</title>
</head>

<body>
	<?php
		$CounterFile = "hitcount.txt";
		
		if(file_exists($CounterFile)){
			$Hits = file_get_contents($CounterFile);
			++$Hits;
		}else{
			$Hits = 1;
		}
		
		echo "<h1>There have been $Hits hits to this page.</h1>\n";
		if(file_put_contents($CounterFile, $Hits)){
			echo "<p>The counter file has been updated.</p>\n";
		}
	?>
</body>
</html>