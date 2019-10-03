<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Request Dump</title>
	<style>
		th {
			background-color:#ABD5F7;
		}
		td {
			width: 200px;
			text-align: center;
		}
	</style>
</head>

<body>
	<form name="contact" action="RequestDump.php" method="post">
		First Name: <input type="text" name="firstName" /><br />
		Last Name: <input type="text" name="lastName" /><br />
		e-mail Address: <input type="text" name="email" /><br />
		Street Address: <input type="text" name="street" /><br />
		City: <input type="text" name="city" /><br />
		Province: <input type="text" name="province" /><br />
		Postal Code: <input type="text" name="postalCode" /><br />
		Phone Number: <input type="text" name="phone" /><br /><br/>
  		<input type="reset" value="Clear Form and Table" onclick="location.href='?';" />&nbsp;&nbsp;
		<input type="submit" value="Send Form" name="Submit" />
	</form>
	<?php
		include("inc_requestDump.php");
	?>
</body>
</html>