<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Airline Survey | Processing</title>
</head>

<body>
	<?php
		$TheStatusMessage = "";
		
		if((empty($_POST['flightTimeDate'])) || (empty($_POST['flightNumber'])) || (empty($_POST['airline'])) || (empty($_POST['friendliness'])) || (empty($_POST['space'])) || (empty($_POST['comfort'])) || (empty($_POST['clean'])) || (empty($_POST['noise']))){
			if(isset($_POST['submitAirSurvey'])){
				$TheStatusMessage = "All fields in Airline Survey are required.<br />Click your browser's Back button, or the \"create new Airline Survey\" link, to return and re-do your survey.";
			}
		}else{
			$DBConnect = @mysqli_connect("localhost", "root", "");
			if($DBConnect === FALSE){
				$TheStatusMessage = "<p>Unable to connect to the database server.</p><p>Error code ". mysqli_errno() .": ".  mysqli_error() ."</p>";
			}else{
				$DBName = "airlineSurveys";
				if(!@mysqli_select_db($DBConnect, $DBName)){
					$SQLstring = "CREATE DATABASE $DBName";
					$QueryResult = @mysqli_query($DBConnect, $SQLstring);
					if($QueryResult === FALSE){
						$TheStatusMessage = "<p>Unable to execute the query.</p><p>Error code ". mysqli_errno($DBConnect) .": ". mysqli_error($DBConnect) ."</p>";
					}else{
						$TheStatusMessage = "<p>You've just created the first Airline Survey!</p>";
					}
				}
				mysqli_select_db($DBConnect, $DBName);
				$TableName = "answers";
				$SQLstring = "SHOW TABLES LIKE '$TableName'";
				$QueryResult = @mysqli_query($DBConnect, $SQLstring);
				if(mysqli_num_rows($QueryResult) == 0){
					$SQLstring = "CREATE TABLE $TableName (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
						flightTime DATETIME, flightNum VARCHAR(20), airlineCo VARCHAR(30), friendly VARCHAR(20), enoughSpace VARCHAR(20), enoughComfort VARCHAR(20),
						enoughClean VARCHAR(20), enoughQuiet VARCHAR(20))";
					$QueryResult = @mysqli_query($DBConnect, $SQLstring);
					if($QueryResult === FALSE){
						$TheStatusMessage = "<p>Unable to create the table.</p><p>Error code ". mysqli_errno($DBConnect) .": ". mysqli_error($DBConnect) ."</p>";
					}
				}
				$AirDateTime = date("Y-m-d H:i:s", strtotime($_POST['flightTimeDate']));
				$AirFlightNum = stripslashes($_POST['flightNumber']);
				$Airline = stripslashes($_POST['airline']);
				$AirFriend = stripslashes($_POST['friendliness']);
				$AirLugSpace = stripslashes($_POST['space']);
				$AirComfort = stripslashes($_POST['comfort']);
				$AirClean = stripslashes($_POST['clean']);
				$AirNoise = stripslashes($_POST['noise']);
				echo "<h1>Date and Time Variable: ". $AirDateTime ."</h1>";
				
				$SQLstring = "INSERT INTO $TableName VALUES(NULL, '$AirDateTime', '$AirFlightNum', '$Airline', '$AirFriend', '$AirLugSpace', '$AirComfort', '$AirClean', '$AirNoise')";
				$QueryResult = @mysqli_query($DBConnect, $SQLstring);
				if($QueryResult === FALSE){
					$TheStatusMessage = "<p>Unable to execute the query.</p><p>Error code ". mysqli_errno($DBConnect) .": ". mysqli_error($DBConnect) ."</p>";
				}else{
					$TheStatusMessage = "<h3>You've successfully added a new Airline Survey.</h3>";
				}
				mysqli_close($DBConnect);
			}
		}
	?>
	<h1>The Airline Survey Processing Gateway</h1><hr />
	<h2>Choose your option below:</h2>
	<p><a href="AirlineSurveyMainForm.html">create new airline survey</a></p>
	<p><a href="AirlineSurveyViewer.php">view all existing surveys</a></p>
	<h3><?php echo $TheStatusMessage; ?></h3>
</body>
</html>