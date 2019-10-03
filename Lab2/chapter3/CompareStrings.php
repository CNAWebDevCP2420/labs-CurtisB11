<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Compare Strings</title>
</head>

<body>
	<h1>Compare Strings</h1><hr />
	<?php
		$firstString = "Geek2Geek";
		$secondString = "Geezer2Geek";
		
		if(!empty($firstString) && !empty($secondString)){
			if($firstString == $secondString){
				echo "<p>Both strings are the same.</p>";
			}else{
				echo "<p>Both strings have ". similar_text($firstString, $secondString) ." character(s) in common.<br />";
				echo "<p>You must change ". levenshtein($firstString, $secondString) ." character(s) to make the strings the same.<br />";
			}
		}else{
			echo "<p>Either the \$firstString variable or the \$secondString variable does not contain a value, so the two strings cannot be compared.</p>";
		}
	?>
</body>
</html>