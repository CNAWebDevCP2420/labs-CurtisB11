<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Interview Display Results</title>
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
	<h1>The Candidate Interviews Viewer</h1><hr />
	<?php
		$DBConnect = @mysqli_connect("localhost", "root", "");
		if($DBConnect === FALSE){
			echo "<p>Unable to connect to the database server.</p><p>Error code ". mysqli_errno() .": ".  mysqli_error() ."</p>";
		}else{
			$DBName = "jobInterviews";
			if(!@mysqli_select_db($DBConnect, $DBName)){
				echo "<p>There are no entries in the candidate interviews database.</p>";
			}else{
				$TableName = "candidates";
				$SQLstring = "SELECT * FROM $TableName";
				$QueryResult = @mysqli_query($DBConnect, $SQLstring);
				if(mysqli_num_rows($QueryResult) == 0){
					echo "<p>There are no entries in the candidate interviews database.</p>";
				}else{
					echo "<h2>All Candidate Interviews:</h2>\n";
					echo "<table width='100%'>\n";
					echo "<tr>\n<th>ITEM</th><th>Intviewr<br />F&nbsp;Name</th><th>Intviewr<br />L&nbsp;Name</th><th>Interviewer&nbsp;Position<br />Title</th><th>Interview&nbsp;Held<br />On&nbsp;Date</th><th>Cand<br />F&nbsp;Name</th><th>Cand<br />L&nbsp;Name</th><th>Commnctn<br />Ability</th><th>Profssnal<br />Appear</th><th>Comput<br />Skills</th><th>Busness<br />Know</th><th>Interviewer's&nbsp;Comments</th>\n</tr>\n";
					while(($Row = mysqli_fetch_assoc($QueryResult)) !== NULL){
						echo "<tr>\n<td class=\"interviewNum\">{$Row['countID']}</td>\n";
						echo "<td>{$Row['intviewrFirstN']}</td>\n";
						echo "<td>{$Row['intviewrLastN']}</td>\n";
						echo "<td>{$Row['intviewrPos']}</td>\n";
						echo "<td>{$Row['intviewDate']}</td>\n";
						echo "<td>{$Row['candFirstNm']}</td>\n";
						echo "<td>{$Row['candLastNm']}</td>\n";
						echo "<td>{$Row['communicateSklls']}</td>\n";
						echo "<td>{$Row['proAppear']}</td>\n";
						echo "<td>{$Row['compSklls']}</td>\n";
						echo "<td>{$Row['busnssKnow']}</td>\n";
						echo "<td>{$Row['comment']}</td>\n</tr>\n";
					} // end while
					echo "</table>\n";
				} // end if
				mysqli_free_result($QueryResult);
			} // end if
			mysqli_close($DBConnect);
		} // end if
	?>
	<p><a href="InterviewMainForm.html">create a new candidate interview</a></p>
	<br />
</body>
</html>