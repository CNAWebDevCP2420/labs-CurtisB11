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
	
		// This section deals with connecting the database and getting a result-set.
		$DBConnect = @mysqli_connect("localhost", "root", "");
		if($DBConnect === FALSE){
			echo "<p>Unable to connect to the database server.</p><p>Error code ". mysqli_errno() .": ".  mysqli_error() ."</p>";
		}else{
			$DBName = "bugreports";
			if(!@mysqli_select_db($DBConnect, $DBName)){
				echo "<p>There are no entries in the bug report database.</p>";
			}else{
				$TableName = "reports";
				$SQLstring = "SELECT * FROM $TableName";
				$QueryResult = @mysqli_query($DBConnect, $SQLstring);
				$NumberOfListedReports = mysqli_num_rows($QueryResult);
				if($NumberOfListedReports == 0){
					echo "<p>There are no entries in the bug report database.</p>";
				}else{ // Once result-set from database is accessible, we can begin searching and editing.
					
					// Begin Searching for record section here
					if(empty($_POST['report_number'])){
						if(isset($_POST['query'])){
							$SoughtRecordMessage = "<h3>To edit a Bug Report, the text box above cannot be left empty.<br />A valid ITEM Number between 1 and ". $NumberOfListedReports ." must be entered, before pressing \"Submit Query\".<br />If necessary, click \"view all Bug Reports\" link below, to review Bug Reports and choose an ITEM Number.</h3>";
						}
					}else{
						if((!($_POST['report_number'] > 0)) || (!($_POST['report_number'] <= (int)$NumberOfListedReports))){
							$SoughtRecordMessage = "<h3>Your entry is NOT a valid Bug Report ITEM Number.<br />A number between 1 and ". $NumberOfListedReports ." must be entered, before pressing \"Submit Query\".<br />Click \"view Bug Reports\" link below, to re-verify your chosen report's ITEM Number.</h3>";
						}else{
							$StickyReportNumber = $_POST['report_number'];
							$ReportNumber = $_POST['report_number'] - 1;
							mysqli_data_seek($QueryResult, $ReportNumber);
							$Row = mysqli_fetch_row($QueryResult);
							$RecordNumber = $Row[0];
							$ProdName = $Row[1];
							$Hardware = $Row[2];
							$OperatingSystem = $Row[3];
							$TheFrequency = $Row[4];
							$TheSolutions = $Row[5];
						}
					} // end outer if and end search section
					mysqli_free_result($QueryResult);
		
					// Begin using changes made in form, to make edits to database record, here.
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
							$SQLstring = "UPDATE $TableName SET product_name = '$ProdName', hardware_type = '$Hardware', operating_system = '$OperatingSystem', frequency = '$TheFrequency', solutions = '$TheSolutions' WHERE countID = '$RecordNumber'";
							$QueryResult = @mysqli_query($DBConnect, $SQLstring);
							if($QueryResult === FALSE){
								echo "<p>Unable to execute the query.</p><p>Error code ". mysqli_errno($DBConnect) .": ". mysqli_error($DBConnect) ."</p>";
							}else{
								echo "<h1>Your Update has benn successfully applied!<br />Thank you for using our Bug Reporting Service!</h1>";
							}
						}
					} // end outer if and end edit section
					
				} // close all if blocks in database connection section.
			}
			mysqli_close($DBConnect);
		} // end outermost if block at top of page
	?>
	<h1>The Chapter 8 Bug Reporting Portal</h1><hr />
	<h2>Enter number below to edit a Bug Report</h2>
	<form method="POST" action="BugReportCh8Edit.php">
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
	
	<p><a href="BugReportCh8MainPage.html">home</a></p>
	<p><a href="BugReportCh8CreateNew.html">create a new bug report</a></p>
	<p><a href="BugReportCh8View.php">view all bug reports</a></p>
	<p><?php echo $TheResultMessage; ?></p>
</body>
</html>