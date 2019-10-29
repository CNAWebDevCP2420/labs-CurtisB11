<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bug Report Viewer</title>
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
	<h1>The Bug Reporting Portal</h1><hr />
	<h2>Viewer: All Bug Reports</h2>
	<hr />
	<?php
		$BugReportsList = file("bugreports.txt");
		$BugReportsFile = "bugreports.txt";
		$permissions = fileperms($BugReportsFile);
		$permissions = decoct($permissions % 01000);
		echo "<br /><p>file permissions for $BugReportsFile: 0". $permissions ."<p>\n";
		echo "<table>\n";
		echo "<tr>\n";
		echo "<th>ITEM</th><th>Product Name<br />and Number</th><th>Hardware<br />Type</th><th>Operating<br />System</th><th>Occurance<br />Count</th><th>Proposed<br />Solution</th>";
		echo "</tr>\n";
		if(file_put_contents($BugReportsFile, $BugReportsList) != 0){
			for($y = 0; $y < count($BugReportsList); ++$y){
				$ThisRecord = explode(", ", $BugReportsList[$y]);
				echo "<tr>\n";
				echo "<td class=\"reportNumber\">". ($y + 1) ." </td><td class=\"nameProduct\">". stripslashes($ThisRecord[0]) ."</td>";
				echo "<td class=\"hardware\">". stripslashes($ThisRecord[1]) ."</td><td class=\"operatingSystem\">". stripslashes($ThisRecord[2]) ."</td>";
				echo "<td class=\"occurances\">". stripslashes($ThisRecord[3]) ."</td><td class=\"proposal\">". stripslashes($ThisRecord[4]) ."</td>\n";
				echo "</tr>\n";
			}
			echo "</table>\n";
		}else{
			echo "<p>No one has yet reported a bug.</p>";
		}
	?>
	<h2>Choose your option below:</h2>
	<p><a href="BugReportMainPage.html">home</a></p>
	<p><a href="BugReportCreateNew.html">create a new bug report</a></p>
	<p><a href="BugReportEdit.php">update an existing bug report</a></p>
</body>
</html>