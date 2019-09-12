<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Returned Value</title>
</head>

<body>
	<p>The following are values for variable ReturnValue:</p>
	<?php
		$ReturnValue = 2 == 3;
		if($ReturnValue == 0){
			$ReturnValue = "FALSE";
		}else if($ReturnValue == 1){
			$ReturnValue = "TRUE";
		}
		echo "For 2 == 3, the value of variable ReturnValue = ". $ReturnValue ."<br />";
		
		$ReturnValue = "2" + "3";
		if($ReturnValue == 0){
			$ReturnValue = "FALSE";
		}else if($ReturnValue == 1){
			$ReturnValue = "TRUE";
		}
		echo "For \"2\" + \"3\", the value of variable ReturnValue = ". $ReturnValue ."<br />";
		
		$ReturnValue = 2 >= 3;
		if($ReturnValue == 0){
			$ReturnValue = "FALSE";
		}else if($ReturnValue == 1){
			$ReturnValue = "TRUE";
		}
		echo "For 2 >= 3, the value of variable ReturnValue = ". $ReturnValue ."<br />";
		
		$ReturnValue = 2 <= 3;
		if($ReturnValue == 0){
			$ReturnValue = "FALSE";
		}else if($ReturnValue == 1){
			$ReturnValue = "TRUE";
		}
		echo "For 2 <= 3, the value of variable ReturnValue = ". $ReturnValue ."<br />";
		
		$ReturnValue = 2 + 3;
		if($ReturnValue == 0){
			$ReturnValue = "FALSE";
		}else if($ReturnValue == 1){
			$ReturnValue = "TRUE";
		}
		echo "For 2 + 3, the value of variable ReturnValue = ". $ReturnValue ."<br />";
		
		$ReturnValue = (2 >= 3) && (2 > 3);
		if($ReturnValue == 0){
			$ReturnValue = "FALSE";
		}else if($ReturnValue == 1){
			$ReturnValue = "TRUE";
		}
		echo "For (2 >= 3) && (2 > 3), the value of variable ReturnValue = ". $ReturnValue ."<br />";
		
		$ReturnValue = (2 >= 3) || (2 > 3);
		if($ReturnValue == 0){
			$ReturnValue = "FALSE";
		}else if($ReturnValue == 1){
			$ReturnValue = "TRUE";
		}
		echo "For (2 >= 3) || (2 > 3), the value of variable ReturnValue = ". $ReturnValue ."<br />";
	?>
</body>
</html>