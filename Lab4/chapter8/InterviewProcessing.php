<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Interview Processing</title>
</head>

<body>
	<?php
		$TheStatusMessage = "";
		
		if((empty($_POST['interviewerFirstName'])) || (empty($_POST['interviewerLastName'])) || (empty($_POST['interviewerPosition'])) || (empty($_POST['interviewDate'])) || (empty($_POST['candidateFirstName'])) || (empty($_POST['candidateLastName'])) || (empty($_POST['commSkills'])) || (empty($_POST['proAppearance'])) || (empty($_POST['compSkills'])) || (empty($_POST['businessKnow'])) || (empty($_POST['comments']))){
			if(isset($_POST['submitCandidate'])){
				$TheStatusMessage = "All Interview Form data fields are required.<br />Click your browser's Back button, or the \"create new Candidate Interview\" link, to return and re-add your Interview.";
			}
		}else{
			$DBConnect = @mysqli_connect("localhost", "root", "");
			if($DBConnect === FALSE){
				$TheStatusMessage = "<p>Unable to connect to the database server.</p><p>Error code ". mysqli_errno() .": ".  mysqli_error() ."</p>";
			}else{
				$DBName = "jobInterviews";
				if(!@mysqli_select_db($DBConnect, $DBName)){
					$SQLstring = "CREATE DATABASE $DBName";
					$QueryResult = @mysqli_query($DBConnect, $SQLstring);
					if($QueryResult === FALSE){
						$TheStatusMessage = "<p>Unable to execute the query.</p><p>Error code ". mysqli_errno($DBConnect) .": ". mysqli_error($DBConnect) ."</p>";
					}else{
						$TheStatusMessage = "<p>You've just created the first job interview!</p>";
					}
				}
				mysqli_select_db($DBConnect, $DBName);
				$TableName = "candidates";
				$SQLstring = "SHOW TABLES LIKE '$TableName'";
				$QueryResult = @mysqli_query($DBConnect, $SQLstring);
				if(mysqli_num_rows($QueryResult) == 0){
					$SQLstring = "CREATE TABLE $TableName (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
						intviewrFirstN VARCHAR(30), intviewrLastN VARCHAR(30), intviewrPos VARCHAR(30), intviewDate DATE, candFirstNm VARCHAR(30), candLastNm VARCHAR(30),
						communicateSklls VARCHAR(20), proAppear VARCHAR(20), compSklls VARCHAR(20), busnssKnow VARCHAR(20), comment TEXT)";
					$QueryResult = @mysqli_query($DBConnect, $SQLstring);
					if($QueryResult === FALSE){
						$TheStatusMessage = "<p>Unable to create the table.</p><p>Error code ". mysqli_errno($DBConnect) .": ". mysqli_error($DBConnect) ."</p>";
					}
				}
				$IntFrstName = stripslashes($_POST['interviewerFirstName']);
				$IntLstName = stripslashes($_POST['interviewerLastName']);
				$IntPosition = stripslashes($_POST['interviewerPosition']);
				$IntDate = date("Y-m-d", strtotime($_POST['interviewDate']));
				$CandFrstName = stripslashes($_POST['candidateFirstName']);
				$CandLstName = stripslashes($_POST['candidateLastName']);
				$CandComm = stripslashes($_POST['commSkills']);
				$CandAppear = stripslashes($_POST['proAppearance']);
				$CandComputer = stripslashes($_POST['compSkills']);
				$CandBusnss = stripslashes($_POST['businessKnow']);
				$CandComment = mysqli_real_escape_string($DBConnect, $_POST['comments']);
				
				$SQLstring = "INSERT INTO $TableName VALUES(NULL, '$IntFrstName', '$IntLstName', '$IntPosition', '$IntDate', '$CandFrstName', '$CandLstName', '$CandComm', '$CandAppear', '$CandComputer', '$CandBusnss', '$CandComment')";
				$QueryResult = @mysqli_query($DBConnect, $SQLstring);
				if($QueryResult === FALSE){
					$TheStatusMessage = "<p>Unable to execute the query.</p><p>Error code ". mysqli_errno($DBConnect) .": ". mysqli_error($DBConnect) ."</p>";
				}else{
					$TheStatusMessage = "<h3>You've successfully added a new Candidate Interview.</h3>";
				}
				mysqli_close($DBConnect);
			}
		}
	?>
	<h1>The Interview Processing Portal</h1><hr />
	<h2>Choose your option below:</h2>
	<p><a href="InterviewMainForm.html">create new candidate interview</a></p>
	<p><a href="InterviewDisplayResults.php">view all existing interviews</a></p>
	<h3><?php echo $TheStatusMessage; ?></h3>
</body>
</html>