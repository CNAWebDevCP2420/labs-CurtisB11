<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Standard Palindrome Check</title>
</head>

<body>
	<h1>Standard Palindrome Check</h1><hr />
	<?php
		$PhraseOne = "Madam, I'm Adam.";
		$PhraseTwo = "A man, a plan, a canal, Panama.";
		$PhraseThree = "A man, a plan, a canal, Suez.";
		$PhraseFour = "Was it a cat I saw?";
		
		echo isStandardPalindrome($PhraseOne);
		echo isStandardPalindrome($PhraseTwo);
		echo isStandardPalindrome($PhraseThree);
		echo isStandardPalindrome($PhraseFour);
	
		function isStandardPalindrome($theString) {
			$OriginalString = $theString;
    		$theString = preg_replace("/[^A-Za-z]/", "", $theString);
    		$theString = strtolower($theString);
    		if($theString == strrev($theString)){
				$Result = "\"". $OriginalString ."\" has tested positive for being a standard palindrome.<br /><br />";
			}else{
				$Result = "\"". $OriginalString ."\" is NOT a palindrome.<br /><br />";
			}
			return $Result;
		}
	?>
</body>
</html>