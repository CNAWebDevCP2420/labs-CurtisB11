<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pictures Display</title>
</head>

<body>
	<h1>Alumni Attending Our High School Reunion</h1>
	<?php
		$file = "alumniProfiles.txt";
		$RecordLine = file($file);
		$NumLines = (count(file($file)));		
		$AlumniCollection = fopen($file, "rb");
		$Count = 0;
		$AnAlumni = fgets($AlumniCollection);
		if(empty($AnAlumni)){
			echo "<p>There isn't anyone added to the Alumni Postings yet.</p>";
			echo "<p>You need to return to the form and add someone before you can view.</p>";
		}else{
			while(!(feof($AlumniCollection)) && !($Count >= $NumLines)){
				$ARecord = explode(", ", $RecordLine[$Count]);
				echo "<p><strong>Alumni ". ($Count + 1) ."</strong><br />";
				echo "Name:  {$ARecord[0]}<br />";
				echo "Image Description: {$ARecord[1]}<br />";
				echo "<img src=\"{$ARecord[2]}\" alt=\"Profile Photo\"><br>\n";
				++$Count;
			} // end while
			fclose($AlumniCollection);
		} // end if
		echo "<p><a href='PicturesUploadForm.html'>Return to Add Alumni Form</a></p>";
	?>
</body>
</html>