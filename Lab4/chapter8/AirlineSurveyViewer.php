<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Airline Survey | Viewer</title>
	<style>
		table {
			background-color: lightgray;
			width: 100%;
			border: 1px solid black;
			border-collapse: collapse;
		}
	
		th {
			height: 60px;
			background-color: gray;
			color: white;
			border: 1px solid black;
			border-collapse: collapse;
		}
	
		td {
			height: 50px;
			border: 1px solid black;
			border-collapse: collapse;
			text-align: center;
		}
	
		.interviewNum {
			background-color: gray;
			color: white;
			font-weight: bold;
			font-size: 20px;
			text-align: center;
		}
	</style>
</head>

<body>
	<h1>The Airline Surveys Viewer</h1><hr />
	<?php
		$DBConnect = @mysqli_connect("localhost", "root", "");
		if($DBConnect === FALSE){
			echo "<p>Unable to connect to the database server.</p><p>Error code ". mysqli_errno() .": ".  mysqli_error() ."</p>";
		}else{
			$DBName = "airlineSurveys";
			if(!@mysqli_select_db($DBConnect, $DBName)){
				echo "<p>There are no entries in the airline surveys database.</p>";
			}else{
				$TableName = "answers";
				$SQLstring = "SELECT * FROM $TableName";
				$QueryResult = @mysqli_query($DBConnect, $SQLstring);
				if(mysqli_num_rows($QueryResult) == 0){
					echo "<p>There are no entries in the airline surveys database.</p>";
				}else{
					echo "<h2>All Airline Surveys:</h2>\n";
					echo "<table width='100%'>\n";
					echo "<tr>\n<th>ITEM</th><th>Date and Time<br />of Flight</th><th>Flight<br />Number</th><th>Airline<br />Name</th><th>Friendly<br />Staff</th><th>Luggage<br />Space</th><th>Seating<br />Comfort</th><th>Clean<br />Aircraft</th><th>Noise<br />Levels</th>\n</tr>\n";
					while(($Row = mysqli_fetch_assoc($QueryResult)) !== NULL){
						echo "<tr>\n<td class=\"interviewNum\">{$Row['countID']}</td>\n";
						echo "<td>{$Row['flightTime']}</td>\n";
						echo "<td>{$Row['flightNum']}</td>\n";
						echo "<td>{$Row['airlineCo']}</td>\n";
						echo "<td>{$Row['friendly']}</td>\n";
						echo "<td>{$Row['enoughSpace']}</td>\n";
						echo "<td>{$Row['enoughComfort']}</td>\n";
						echo "<td>{$Row['enoughClean']}</td>\n";
						echo "<td>{$Row['enoughQuiet']}</td>\n</tr>\n";
					} // end while
					echo "</table>\n";
				} // end if
				mysqli_free_result($QueryResult);
			} // end if
			mysqli_close($DBConnect);
		} // end if
	?>
	<p><a href="AirlineSurveyMainForm.html">complete a new airline survey</a></p>
	<br />
</body>
</html>