<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bug Report | Edit Data File</title>
</head>

<body>
	<?php
		$StickyReportNumber = "";
		$ProdName = "";
		$Hardware = "";
		$OperatingSystem = "";
		$TheFrequency = "";
		$TheSolutions = "";
		$SoughtRecordMessage = "";
		$TheResultMessage = "";
		
		$file = "bugreports.txt";
		$AllTheRecords = file($file);
		$NumberOfListedReports = count($AllTheRecords);
		$ARecord = array_fill(0, $NumberOfListedReports, "");
	
		if(empty($_POST['report_number'])){
			if(isset($_POST['query'])){
				$SoughtRecordMessage = "<h3>To edit a Bug Report, the text box above cannot be left empty.<br />A valid ITEM Number between 1 and ". $NumberOfListedReports ." must be entered, before pressing \"Submit Query\".<br />If necessary, click \"view all Bug Reports\" link below, to review Bug Reports and choose an ITEM Number.</h3>";
			}
		}else{
			if((!($_POST['report_number'] > 0)) || (!($_POST['report_number'] <= (int)$NumberOfListedReports))){
				$SoughtRecordMessage = "<h3>Your entry is NOT a valid Bug Report ITEM Number.<br />A number between 1 and ". $NumberOfListedReports ." must be entered, before pressing \"Submit Query\".<br />Click \"view Bug Reports\" link below, to re-verify your chosen report's ITEM Number.</h3>";
			}else{
				$AllRecords = file($file);
				$StickyReportNumber = $_POST['report_number'];
				$ReportNumber = $_POST['report_number'] - 1;
				$ARecord = explode(", ", $AllRecords[$ReportNumber]);
				$ProdName = $ARecord[0];
				$Hardware = $ARecord[1];
				$OperatingSystem = $ARecord[2];
				$TheFrequency = $ARecord[3];
				$TheSolutions = $ARecord[4];			
			}
		} // end outer if and end search section
		
		if((empty($_POST['product_name'])) || (empty($_POST['hardware_type'])) || (empty($_POST['operating_system'])) || (empty($_POST['frequency'])) || (empty($_POST['solutions'])) ){
			if(isset($_POST['update'])){
				$TheResultMessage = "<h3>You need to search for a Bug Report before you can edit one, and no report fields can be left empty, unselected, or blank.</h3>\n";
			}
		}else{
			if(isset($_POST['update'])){
				$ProdName = addslashes($_POST['product_name']);
				$Hardware = addslashes($_POST['hardware_type']);
				$OperatingSystem = addslashes($_POST['operating_system']);
				$TheFrequency = addslashes($_POST['frequency']);
				$TheSolutions = addslashes($_POST['solutions']);
				$CompileEditedBugReport = array($ProdName, $Hardware, $OperatingSystem, $TheFrequency, $TheSolutions);
				$NewlyEditedBugReport = implode(", ",$CompileEditedBugReport);
				array_splice($AllRecords, $ReportNumber, 1, $NewlyEditedBugReport);
				
				$BugReports = fopen("bugreports.txt", "wb");
				if(is_writeable("bugreports.txt")){
					for($a = 0; $a < count($AllRecords); ++$a){
						fwrite($BugReports, $AllRecords[$a]);
					}
					fclose($BugReports);
					$ARecord = explode(", ", $AllRecords[$ReportNumber]);
					$ProdName = $ARecord[0];
					$Hardware = $ARecord[1];
					$OperatingSystem = $ARecord[2];
					$TheFrequency = $ARecord[3];
					$TheSolutions = $ARecord[4];
					$TheResultMessage = "<h3>Your update was successfully applied to the text file.</h3>\n";
				}else{
					$TheResultMessage = "<h3>Cannot write to the file.</h3>\n";
				}
			}
		} // end outer if and end edit section
	?>
	
	<h1>The Bug Reporting Portal</h1><hr />
	<h2>Enter number below to edit a Bug Report</h2>
	<form method="POST" action="BugReportEdit.php">
		<p>Enter a Bug Report ITEM Number that ranges between 1 and <?php echo $NumberOfListedReports; ?> <input type="text" name="report_number" value="<?php echo $StickyReportNumber; ?>" /></p>
		<p><input type="submit" name="query" value="Submit Query" /></p>
		<p><?php echo $SoughtRecordMessage; ?></p>
		<hr />
		<p>Enter Changes Below:</p>
		<p>Product Name and Version <input type="text" name="product_name" value="<?php echo $ProdName; ?>" /></p>
		<p>
			Type of Hardware
			<select name="hardware_type">
				<option value="" selected="selected">set changes below...</option>
				<option <?php echo ($Hardware == "desktop")?"selected":""; ?> value="desktop">Desktop Computer</option>
				<option <?php echo ($Hardware == "laptop")?"selected":""; ?> value="laptop">Laptop Computer</option>
				<option <?php echo ($Hardware == "tablet")?"selected":""; ?> value="tablet">Tablet</option>
				<option <?php echo ($Hardware == "phone")?"selected":""; ?> value="phone">Mobile Phone</option>
			</select>
		</p>
		<p>
			Operating System
			<select name="operating_system">
				<option value="" selected="selected">set changes below...</option>
  				<option <?php echo ($OperatingSystem == "windows")?"selected":""; ?> value="windows">Windows</option>
  				<option <?php echo ($OperatingSystem == "osx")?"selected":""; ?> value="osx">Mac OS</option>
  				<option <?php echo ($OperatingSystem == "linux")?"selected":""; ?> value="linux">Linux</option>
  				<option <?php echo ($OperatingSystem == "ios")?"selected":""; ?> value="ios">iOS</option>
				<option <?php echo ($OperatingSystem == "android")?"selected":""; ?> value="android">Android</option>
			</select>
		</p>
		<p>Frequency of Occurance <input type="text" name="frequency" value="<?php echo $TheFrequency; ?>" /></p>
		<p>Proposed Solutions <textarea name="solutions" rows="4" cols="50"><?php echo htmlspecialchars(stripslashes($TheSolutions)); ?></textarea></p>
		<p><input type="submit" name="update" value="Update File" /></p>
	</form>
	
	<p><a href="BugReportMainPage.html">home</a></p>
	<p><a href="BugReportCreateNew.html">create a new bug report</a></p>
	<p><a href="BugReportView.php">view all bug reports</a></p>
	<p><?php echo $TheResultMessage; ?></p>
</body>
</html>