<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Bug Report Chapter 8 Viewer</title>
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
		}
	
		.reportNumber {
			width: 15%;
			background-color: gray;
			color: white;
			font-weight: bold;
			font-size: 20px;
			text-align: center;
		/*	padding-left: 20px; */
		}
	
		.nameProduct {
			width: 20%;
			padding-left: 20px;
		}
	
		.hardware, .operatingSystem {
			width: 10%;
			padding-left: 20px;
		}
	
		.occurances {
			width: 10%;
			text-align: center;
		}
	
		.proposal {
			width: 35%;
			padding-left: 20px;
		}
	</style>
</head>

<body>
	<h1>The Bug Reporting Chapter 8 Portal</h1><hr />
	<?php
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
				if(mysqli_num_rows($QueryResult) == 0){
					echo "<p>There are no entries in the bug report database.</p>";
				}else{
					echo "<h2>Viewer: All Bug Reports:</h2>\n";
					echo "<table width='100%' border='1'>\n";
					echo "<tr>\n<th>ITEM</th><th>Product Name<br />and Number</th><th>Hardware<br />Type</th><th>Operating<br />System</th><th>Occurance<br />Count</th><th>Proposed<br />Solution</th>\n</tr>\n";
					while(($Row = mysqli_fetch_assoc($QueryResult)) !== NULL){
						echo "<tr>\n<td class=\"reportNumber\">{$Row['countID']}</td>\n";
						echo "<td class=\"nameProduct\">{$Row['product_name']}</td>\n";
						echo "<td class=\"hardware\">{$Row['hardware_type']}</td>\n";
						echo "<td class=\"operatingSystem\">{$Row['operating_system']}</td>\n";
						echo "<td class=\"occurances\">{$Row['frequency']}</td>\n";
						echo "<td class=\"proposal\">{$Row['solutions']}</td>\n</tr>\n";
					} // end while
					echo "</table>\n";
				} // end if
				mysqli_free_result($QueryResult);
			} // end if
			mysqli_close($DBConnect);
		} // end if
	?>
	<h2>Choose your option below:</h2>
	<p><a href="BugReportCh8MainPage.html">home</a></p>
	<p><a href="BugReportCh8CreateNew.html">create a new bug report</a></p>
	<p><a href="BugReportCh8Edit.php">update an existing bug report</a></p>
	<br />
</body>
</html>