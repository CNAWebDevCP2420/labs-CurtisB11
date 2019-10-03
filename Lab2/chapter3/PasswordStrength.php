<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Password Strength</title>
</head>

<body>
	<h1>Password Strength</h1><hr />
	<?php
		$Passwords = array("12345AB%CDE", "ABCDEfghi*j", "AB123ab%!", "ab!cde9876", "ABC123abc", "123 ABCabc", "abcAB12", "!^ab12ABC", "123ABabc@45678deFGH", "abc123AB%");
		
		for($x = 0; $x < count($Passwords); ++$x){
			$UpperCaseLetters = preg_match("/[A-Z]/", $Passwords[$x]);
			$LowerCaseLetters = preg_match("/[a-z]/", $Passwords[$x]);
			$NumbersTest = preg_match("/[0-9]/", $Passwords[$x]);
			$SpecialCharacters = preg_match("/[^0-9A-Za-z]/", $Passwords[$x]);
			$SpacesTest = preg_match("/[\s]/", $Passwords[$x]);
			$LengthTest = strlen($Passwords[$x]);
			if(!($UpperCaseLetters)){
				echo "Invalid password: ". $Passwords[$x] ." at position ". ($x + 1) .": doesn't contain any uppercase letters.<br /><br />";
			}
			if(!($LowerCaseLetters)){
				echo "Invalid password: ". $Passwords[$x] ." at position ". ($x + 1) .": doesn't contain any lowercase letters.<br /><br />";
			}
			if(!($NumbersTest)){
				echo "Invalid password: ". $Passwords[$x] ." at position ". ($x + 1) .": doesn't contain any numbers.<br /><br />";
			}
/*			if(!(preg_match("/[^\w]/", $Passwords[$x]))){
				echo "Password: ". $Passwords[$x] ." at position ". ($x + 1) .": doesn't contain special characters.<br /><br />";
			}
*/			if(!($SpecialCharacters)){
				echo "Invalid password: ". $Passwords[$x] ." at position ". ($x + 1) .": doesn't contain any special characters.<br /><br />";
			}
			if($SpacesTest){
				echo "Invalid password: ". $Passwords[$x] ." at position ". ($x + 1) .": contains at least one illegal space.<br /><br />";
			}
			if($LengthTest < 8){
				echo "Invalid password: ". $Passwords[$x] ." at position ". ($x + 1) .": contains fewer than 8 characters.<br /><br />";
			}
			if($LengthTest > 16){
				echo "Invalid password: ". $Passwords[$x] ." at position ". ($x + 1) .": contains more than 16 characters.<br /><br />";
			}
			if($UpperCaseLetters && $LowerCaseLetters && $NumbersTest && $SpecialCharacters && !$SpacesTest && $LengthTest > 8 && $LengthTest < 16){
				echo "This is a STRONG and VALID password: ". $Passwords[$x] ." at position ". ($x + 1) .". CONGRATULATIONS!<br /><br />";
			}
		} // end for
	?>
</body>
</html>