<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Pictures</title>
</head>

<body>
	<?php
		if((empty($_POST['alumni_name'])) || (empty($_POST['image_description'])) || (empty($_POST['profile_pic']))){
			echo "<p>All Alumni Picture Form data fields are required.<br />Only complete profiles will be added to the database.</p>\n";
		}else{
			$AlumniName = addslashes($_POST['alumni_name']);
			$Description = addslashes($_POST['image_description']);
			$ProfilePic = "images/". basename($_POST['profile_pic']);
			$AlumniProfile = fopen("alumniProfiles.txt", "ab");
			if(is_writeable("alumniProfiles.txt")){
				if(fwrite($AlumniProfile, $AlumniName .", ". $Description .", ". $ProfilePic ."\n")){
					echo "<p>You've successfully added a new alumni.</p>\n";
				}else{
					"<p>Cannot add your entries to the alumni.</p>\n";
				}
			}else{
				echo "<p>Cannot write to the file.</p>\n";
			}
			fclose($AlumniProfile);
		}
		echo "<p><a href='PicturesDisplay.php'>Display Profiles</a></p>";
		echo "<p><a href='PicturesUploadForm.html'>Return to Add Alumni Form</a></p>";
	?>
</body>
</html>