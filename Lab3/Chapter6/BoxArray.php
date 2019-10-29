<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Box Array</title>
</head>

<body>
	<h2>Box Volume:</h2>
	<hr />
	<p>Using foreach loop:</p>
	<?php
		$MeasurementsForSmallBox = array("BoxSize" => "small", "Length" => 12, "Width" => 10, "Depth" => 2.5);
		$MeasurementsForMediumBox = array("BoxSize" => "medium", "Length" => 30, "Width" => 20, "Depth" => 4);
		$MeasurementsForLargeBox = array("BoxSize" => "large", "Length" => 60, "Width" => 40, "Depth" => 11.5);
		$Boxes = array("SmallBox" => $MeasurementsForSmallBox, "MediumBox" => $MeasurementsForMediumBox, "LargeBox" => $MeasurementsForLargeBox);
	
		foreach($Boxes as $MeasurementsForBox => $Measurements){
			$BoxVolume = $Measurements['Length'] * $Measurements['Width'] * $Measurements['Depth'];
			echo "The volume of a ". $Measurements['BoxSize'] ." box is: ". $BoxVolume ." cubic inches.<br />\n";
		}
		
		// alternate, but less efficient method below:
		echo "<br /><hr /><br />";
		echo "<p>Using long-handed approach:</p>";
		
		$SmallBoxLength = $Boxes['SmallBox']['Length'];
		$SmallBoxWidth = $Boxes['SmallBox']['Width'];
		$SmallBoxDepth = $Boxes['SmallBox']['Depth'];
		$SmallBoxVolume = $SmallBoxLength * $SmallBoxWidth * $SmallBoxDepth;
		echo "The volume of a small box is: ". $SmallBoxVolume ." cubic inches.<br />\n";
		
		$MediumBoxLength = $Boxes['MediumBox']['Length'];
		$MediumBoxWidth = $Boxes['MediumBox']['Width'];
		$MediumBoxDepth = $Boxes['MediumBox']['Depth'];
		$MediumBoxVolume = $MediumBoxLength * $MediumBoxWidth * $MediumBoxDepth;
		echo "The volume of a medium box is: ". $MediumBoxVolume ." cubic inches.<br />\n";
		
		$LargeBoxLength = $Boxes['LargeBox']['Length'];
		$LargeBoxWidth = $Boxes['LargeBox']['Width'];
		$LargeBoxDepth = $Boxes['LargeBox']['Depth'];
		$LargeBoxVolume = $LargeBoxLength * $LargeBoxWidth * $LargeBoxDepth;
		echo "The volume of a large box is: ". $LargeBoxVolume ." cubic inches.<br />\n";
	?>
</body>
</html>