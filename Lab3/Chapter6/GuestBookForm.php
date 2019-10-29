<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Guest Book | Posting Form</title>
</head>

<body>
	<?php
		if(isset($_POST['submit'])){
			$AlreadyPosted = false;
			$YourName = stripslashes($_POST['yourName']);
			$EMail = stripslashes($_POST['emailAddress']);
			$YourName = str_replace("~", "-", $YourName); // replace any "~" characters with "-" characters
			$EMail = str_replace("~", "-", $EMail);
			$GuestBookRecord = "$YourName~$EMail\n";
			$PreviousSubmissionsArray = array();
			if((file_exists("GuestBook/guestEntries.txt")) && (filesize("GuestBook/guestEntries.txt") > 0)){
				$PreviousSubmissionsArray = file("GuestBook/guestEntries.txt");
				$Count = count($PreviousSubmissionsArray);
				for($s = 0; $s < $Count; ++$s){
					$PreviousPosts = explode("~", $PreviousSubmissionsArray[$s]);
					if(in_array($YourName, $PreviousPosts)){
						$AlreadyPosted = true;
					} // end if
				} // end for
				if($AlreadyPosted === true){
					echo "<p>Your name already exists in the guest book!<br />\n";
					echo "Your name was not re-added.</p>";
				}else{
					$GuestBookFile = fopen("GuestBook/guestEntries.txt", "ab");
					if($GuestBookFile === false){
						echo "There was an error saving your guest book entry!\n";
					}else{
						fwrite($GuestBookFile, $GuestBookRecord);
						fclose($GuestBookFile);
						echo "Your entry into Curtis\' Guest Book has been saved.\n";
					} // end third nested and innermost if
				} // end second nested inner if
			} // end inner if
		} // enf outer if
	?>
	<h2>Curtis' Guest Book</h2>
	<h3>Posting Form</h3>
	<form action="GuestBookForm.php" method="post">
		<p>
			Your Name:
			<input type="text" name="yourName" />
		</p>
		<p>
			e-mail Address:
			<input type="text" name="emailAddress" />
		</p>
		<p>
			<input type="reset" value="Reset Form" />
			<input type="submit" name="submit" value="Add to Guestbook" />
		</p>
	</form>
	<a href="GuestBookViewer.php">View Guestbook</a>
</body>
</html>