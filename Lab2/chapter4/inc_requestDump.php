<?php
	if(isset($_POST['Submit'])){
		echo "<br /><br/>\n";
		echo "<table border='1'>\n";
		echo "<tr>\n";
		echo "<th>Name</th>";
		echo "<th>Value</th>\n";
		echo "</tr>\n";
		foreach($_REQUEST as $name => $value){
			$TableRow = "<tr>\n<td>". htmlentities(stripslashes($name)) ."</td><td>". htmlentities(stripslashes($value)) ."</td>\n</tr>\n";
			echo $TableRow;
		}
		echo "</table>";
	}
?>
	
