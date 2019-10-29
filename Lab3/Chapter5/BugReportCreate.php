<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Creation of Bug Report</title>
</head>

<body>
	<?php
		$TheStatusMessage = "";
	
		if((empty($_POST['product_name'])) || (empty($_POST['hardware_type'])) || (empty($_POST['operating_system'])) || (empty($_POST['frequency'])) || (empty($_POST['solutions']))){
			if(isset($_POST['createNewReport'])){
				$TheStatusMessage = "All Bug Form data fields are required.<br />Click your browser's Back button, or the \"create new bug report\" link, to return and re-add your new Bug Report.";
			}
		}else{
			if(isset($_POST['createNewReport'])){
				$ProductName = addslashes($_POST['product_name']);
				$HardwareType = addslashes($_POST['hardware_type']);
				$OperatingSystem = addslashes($_POST['operating_system']);
				$TheFrequency = addslashes($_POST['frequency']);
				$ProposedSolutions = addslashes($_POST['solutions']);
			
				$BugReports = fopen("bugreports.txt", "ab");
				if(is_writeable("bugreports.txt")){
					if(fwrite($BugReports, $ProductName .", ". $HardwareType .", ". $OperatingSystem .", ". $TheFrequency .", ". $ProposedSolutions ."\n")){
						$TheStatusMessage = "You've successfully added a new bug report.";
					}else{
						$TheStatusMessage = "Cannot add your entries to the bug report.";
					}
				}else{
					$TheStatusMessage = "Cannot write to the file.";
				}
				fclose($BugReports);
			}
		}
	?>
	<h1>The Bug Reporting Portal</h1><hr />
	<h2>Choose your option below:</h2>
	<p><a href="BugReportMainPage.html">home</a></p>
	<p><a href="BugReportCreateNew.html">create new bug report</a></p>
	<p><a href="BugReportEdit.php">update an existing bug report</a></p>
	<p><a href="BugReportView.php">view all existing bug reports</a></p>
	<h3><?php echo $TheStatusMessage; ?></h3>
</body>
</html>