<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pay Check Details</title>
</head>

<body>
<?php
	define("REGULAR_PAY_HOURS", 40);
	define("OVERTIME_PAY_RATE", 1.5);
	
	function displayError($fieldName, $errorMsg){
		global $errorCount;
		echo "Error for \"$fieldName\": $errorMsg<br />\n";
		++$errorCount;
	} // end method displayError
	
	function validateInput($data, $fieldName){
		global $errorCount;
		if(empty($data)){
			displayError($fieldName, "This field is required");
			$retval = "";
		}else{ // only clean up the input if it isn't empty
			$retval = trim($data);
			$retval = stripslashes($retval);
			if((floatval($retval) < 1) || (floatval($retval) > 120)){
				displayError($fieldName, "Must be between 1 and 120.");
			} // end 1st inner if
			if(preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $retval) == 0){
				displayError($fieldName, "Fields entered can only consist of numbers.");
			} // end 2nd inner if
		} // end if
		return($retval);
	} // end method validateInput
	
	function displayWages($WorkHours, $RatePaid){
		if($WorkHours > REGULAR_PAY_HOURS){
			$OvertimeRatePaid = ($RatePaid * OVERTIME_PAY_RATE);
			$overtimeHours = ($WorkHours - REGULAR_PAY_HOURS);
			$overtimeGrossPay = ($overtimeHours * $OvertimeRatePaid);
			$regularTimeGrossPay = (REGULAR_PAY_HOURS * $RatePaid);
			$GrossPay = ($regularTimeGrossPay + $overtimeGrossPay);
			echo "You have: ". $overtimeHours ." hours that qualify for the overtime rate of: ". number_format($OvertimeRatePaid, 2) ." / hour.<br />";
			echo "Your overtime gross pay is: $". number_format($overtimeGrossPay, 2) ."<br />";
			echo "Your regular time gross pay is: $". number_format($regularTimeGrossPay, 2) ."<br />";
			echo "Gross pay for the week is: $". number_format($GrossPay, 2) ."<br />";
		}else{
			$GrossPay = ($WorkHours * $RatePaid);
			echo "Gross pay for the week is: ". number_format($GrossPay, 2) ."<br />";
		} // end if
		return 1;
	} // end method displayWages
	
	function displayBackButton(){
	//	header('Location: '. $_SERVER['HTTP_REFERER']);
		if(isset($_SERVER['HTTP_REFERER'])) {
    		$previous = $_SERVER['HTTP_REFERER'];
			echo "<input type='button' value='Back to Form' onClick='location.href=\"". $previous ."\";' />";
		}
	} // end method displayForm
	
	$ShowForm = TRUE;
	$errorCount = 0;
	$WorkHours = 0;
	$RatePaid = 0;
		
	if(isset($_POST['Submit'])){
		$WorkHours = validateInput($_POST['hoursWorked'], "Weekly Hours");
		$RatePaid = validateInput($_POST['wageRate'], "Hourly Wage");
		if($errorCount == 0){
			$ShowForm = FALSE;
		}else{
			$ShowForm = TRUE;
		} // end inner if
	} // end outer if
		
	if($ShowForm == TRUE){
		if($errorCount > 0){ // if there were errors
			echo "<p>Please click the back button to re-enter form information.</p>\n";
		} // end first inner if
		displayBackButton();
	}else{
		$result = displayWages($WorkHours, $RatePaid);
		if($result){
			echo "<p>The breakdown on your weekly wages:<br />for: ". $WorkHours ." hours worked, at: $". $RatePaid ." / hour,<br />have been successfully displayed above.</p>\n";
		}else{
			echo "<p>There was an error displaying your wages.</p>\n";
		} // end second inner if
	} // end outer if
?>
</body>
</html>