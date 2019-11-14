<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bug Report Create</title>
</head>

<body>
	<?php
		$TheStatusMessage = "";
		
		if((empty($_POST['product_name'])) || (empty($_POST['hardware_type'])) || (empty($_POST['operating_system'])) || (empty($_POST['frequency'])) || (empty($_POST['solutions']))){
			if(isset($_POST['createNewReport'])){
				$TheStatusMessage = "All Bug Form data fields are required.<br />Click your browser's Back button, or the \"create new bug report\" link, to return and re-add your new Bug Report.";
			}
		}else{
			$DBConnect = @mysqli_connect("localhost", "root", "");
			if($DBConnect === FALSE){
				$TheStatusMessage = "<p>Unable to connect to the database server.</p><p>Error code ". mysqli_errno() .": ".  mysqli_error() ."</p>";
			}else{
				$DBName = "bugreports";
				if(!@mysqli_select_db($DBConnect, $DBName)){
					$SQLstring = "CREATE DATABASE $DBName";
					$QueryResult = @mysqli_query($DBConnect, $SQLstring);
					if($QueryResult === FALSE){
						$TheStatusMessage = "<p>Unable to execute the query.</p><p>Error code ". mysqli_errno($DBConnect) .": ". mysqli_error($DBConnect) ."</p>";
					}else{
						$TheStatusMessage = "<p>You've just created the first bug report!</p>";
					}
				}
				mysqli_select_db($DBConnect, $DBName);
				$TableName = "reports";
				$SQLstring = "SHOW TABLES LIKE '$TableName'";
				$QueryResult = @mysqli_query($DBConnect, $SQLstring);
				if(mysqli_num_rows($QueryResult) == 0){
					$SQLstring = "CREATE TABLE $TableName (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
						product_name VARCHAR(40), hardware_type VARCHAR(20), operating_system VARCHAR(20),
						frequency SMALLINT, solutions TEXT)";
					$QueryResult = @mysqli_query($DBConnect, $SQLstring);
					if($QueryResult === FALSE){
						$TheStatusMessage = "<p>Unable to create the table.</p><p>Error code ". mysqli_errno($DBConnect) .": ". mysqli_error($DBConnect) ."</p>";
					}
				}
				$ProductName = stripslashes($_POST['product_name']);
				$HardwareType = stripslashes($_POST['hardware_type']);
				$OperatingSystem = stripslashes($_POST['operating_system']);
				$Frequency = stripslashes($_POST['frequency']);
				$Solutions = stripslashes($_POST['solutions']);
				
				
				$SQLstring = "INSERT INTO $TableName VALUES(NULL, '$ProductName', '$HardwareType', '$OperatingSystem', '$Frequency', '$Solutions')";
				$QueryResult = @mysqli_query($DBConnect, $SQLstring);
				if($QueryResult === FALSE){
					$TheStatusMessage = "<p>Unable to execute the query.</p><p>Error code ". mysqli_errno($DBConnect) .": ". mysqli_error($DBConnect) ."</p>";
				}else{
					$TheStatusMessage = "<h3>You've successfully added a new bug report.</h3>";
				}
				mysqli_close($DBConnect);
			}
		}
	?>
	<h1>The Bug Reporting Portal</h1><hr />
	<h2>Choose your option below:</h2>
	<p><a href="BugReportCh8MainPage.html">home</a></p>
	<p><a href="BugReportCh8CreateNew.html">create new bug report</a></p>
	<p><a href="BugReportCh8Edit.php">update an existing bug report</a></p>
	<p><a href="BugReportCh8View.php">view all existing bug reports</a></p>
	<h3><?php echo $TheStatusMessage; ?></h3>
</body>
</html>