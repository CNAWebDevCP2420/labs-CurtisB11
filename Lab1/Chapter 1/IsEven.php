<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Is Number Even</title>
</head>

<body>
	<?php
		$initialTestItems = array("42", 1337, "ABCD", "abcd", 1991, 6.7, 6.2, "not numeric", 26, array(), 9.7, NULL);
		echo "<p>Results from whether items in ARRAY initialTestItems are deemed numeric, or non-numeric:</p>";
		
		foreach ($initialTestItems as $element) {
    		if (is_numeric($element) === TRUE) {
        		echo $element . " is numeric<br />";
				$element = round($element);
				if($element % 2 === 0){
					$numbersArray[] = $element;
				}
    		} else {
        		echo var_export($element, true) ." is NOT numeric<br />";
    		}
		}
		
		echo "<br /><br />Values of only the valid even numbers (after rounding) are:<br />";
		for($n = 0; $n < count($numbersArray); ++$n){
			echo $numbersArray[$n] ."<br />";
		}
	?>
</body>
</html>