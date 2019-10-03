<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Two Trains</title>
</head>

<body>
	<?php
		function displayForm($SpeedA, $SpeedB, $Distance){
	?>
		<br />
		<form name="aboutTrains" method="post" action="TwoTrains.php">
			Speed Train A: <input type="text" id="theTrainA" name="speedTrainAAA" value="<?php echo $SpeedA; ?>" /> km/h<br />
			Speed Train B: <input type="text" id="theTrainB" name="speedTrainBBB" value="<?php echo $SpeedB; ?>" /> km/h<br />
			Distance Between: <input type="text" id="theDistance" name="distance" value="<?php echo $Distance; ?>" /> km<br /><br />
			<input type="reset" value="Clear Form" onclick="location.href='?';" />&nbsp;&nbsp;
			<input type="submit" value="Send Form" name="Submit" />
		</form>
	<?php
		} // end method displayForm
		
		function displayError($fieldName, $errorMsg){
			global $errorCount;
			echo "<br />Error for \"$fieldName\": $errorMsg<br />\n";
			++$errorCount;
		} // end method displayError
		
		function validateEntry($data, $fieldName){
	/*		echo '<script type="text/javascript">alert("Value in:\n$fieldName: "+'. "\"$fieldName\"" .'+"\n$data: "+'. $data .');</script>'; */
			global $errorCount;
			if(empty($data)){
				displayError($fieldName, "This field is required. It cannot be set to zero, or left empty.");
				$returnValue = "";
			} else { // only clean up the input if it isn't empty
				$returnValue = trim($data);
				if(!(is_numeric($data))) {
					displayError($fieldName, "Only numeric entries are permitted, monkeyhead! Your entry: \"". $data ."\" is NOT valid.");
					$returnValue = "";
				} // end 1st inner if
				if(!($data > 0) && (is_numeric($data))){
					displayError($fieldName, "All numbers entered must be greater than zero. Your negative number entry: \"". $data ."\" is NOT valid.");
					$returnValue = "";
				}
			} // end outer if
			return $returnValue;
		} // end method validateWord
		
		$AllowProcessing = FALSE;
		$errorCount = 0;
		$SpeedA = "";
		$SpeedB = "";
		$Distance = "";
		
		if(isset($_POST['Submit'])){
			$SpeedA = validateEntry(htmlentities(stripslashes($_POST["speedTrainAAA"])), "Speed Train A");
			$SpeedB = validateEntry(htmlentities(stripslashes($_POST["speedTrainBBB"])), "Speed Train B");
			$Distance = validateEntry(htmlentities(stripslashes($_POST["distance"])), "Distance Between");
			if($errorCount == 0){
				$AllowProcessing = TRUE;
			}else{
				$AllowProcessing = FALSE;
			} // end inner if
		}
		
		if($AllowProcessing == FALSE){
			if($errorCount > 0){
				echo "<br />To get a result, you'll need to re-enter any data that contained errors.<br /><br />\n";
			}
			displayForm($SpeedA, $SpeedB, $Distance);
		}else{
			$DistanceA = (($SpeedA / $SpeedB) * $Distance) / (1 + ($SpeedA / $SpeedB));
			$DistanceB = $Distance - $DistanceA;
			$TimeA = $DistanceA / $SpeedA;
			$TimeB = $DistanceB / $SpeedB;
			echo "<br />";
			echo "Speed of Train A: ". $SpeedA ." km/h.<br />Speed of Train B: ". $SpeedB ." km/h.<br />Distance between trains: ". $Distance ." km.<br /><br />";
			echo "The distance travelled by Train A is: ". round($DistanceA, 1) ." km. It took: ". round(($TimeA * 60), 1) ." minutes.<br />";
			echo "The distance travelled by Train B is: ". round($DistanceB, 1) ." km. It took: ". round(($TimeB * 60), 1) ." minutes.<br />";
		}
	?>
	
	
</body>
</html>