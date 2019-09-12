<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Interest Array</title>
</head>

<body>
	<?php
		$InterestRate1 = .0725;
		$InterestRate2 = .0750;
		$InterestRate3 = .0775;
		$InterestRate4 = .0800;
		$InterestRate5 = .0825;
		$InterestRate6 = .0850;
		$InterestRate7 = .0875;
		
		$RatesArray = array($InterestRate1, $InterestRate2, $InterestRate3, $InterestRate4, $InterestRate5, $InterestRate6, $InterestRate7);
		
		echo "<p><br />The following ". count($RatesArray) ." listings are the interest rates we charge:</p>";
		
		for ($x = 0; $x < count($RatesArray); ++$x) {
     		echo "Interest rate ". ($x + 1) ." is: ". number_format($RatesArray[$x], 4, '.', '') ."<br />";
		} 
	?>
</body>
</html>