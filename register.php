<?php

// Check if he wants to register:
if (!empty($_POST["username"]))
{
	// Check if passwords match.
	if ($_POST["password"] != $_POST["password2"])
		exit("Error - Passwords don't match. Please go back and try again.");

	// Assign some variables.
	//$date = mktime("d - m - Y");
	//$ip = $_SERVER[REMOTE_ADDR];
	$ID = $_POST["facebookid"];
	$UN = $_POST["username"];
	//$PW = md5($_POST["password"] . $_POST["password"] . $_POST["password"] );

	$PW_temp = bin2hex(hash("sha256", $_POST["password"] . $_POST["password"] . $_POST["password"] ));
	
	$PW = bin2hex(hash("sha256", $_POST["password"]));
	error_log("key_temp: " . $_POST["password"] . " pw " . $PW, 0);

	$FN = $_POST["firstname"];
	$LN = $_POST["lastname"];
	require_once("connect.php");

	// Register him.
	$query = "INSERT INTO users (id, un, pw, fn, ln)
VALUES
('$ID','$UN','$PW','$FN','$LN')";

if (!mysqli_query($con, $query))
{
	die ("Error - Couldn't register user.");
}
	echo "Welcome " . $UN . "! You've been successfully reigstered!<br /><br />
		Please login on your mobile app. <br /><br />
To register another account please click <a href='register.php'><b>here</b></a>.";
	exit();
}

?>

<html>
	<head>
		<title>Register</title>
	</head>
	<body>
		<form action="register.php" method="post">
			<table width="75%" border="1" align="center" cellpadding="3" cellspacing="1">
				<tr>
					<td width="100%"><h5>Registration</h5></td>
				</tr>
				<tr>
					<td width="100%"><label>FaceBookID: <input type="text" name="facebookid" size="25" ></label></td>
				</tr>
				<tr>
					<td width="100%"><label>Username: <input type="text" name="username" size="25" ></label></td>
				</tr>

				<tr>
					<td width="100%"><label>First Name: <input type="text" name="firstname" size="25" ></label></td>
				</tr>
				<tr>
					<td width="100%"><label>Last Name: <input type="text" name="lastname" size="25" ></label></td>
				</tr>
				<tr>
					<td width="100%"><label>Password: <input type="password" name="password" size="25" ></label></td>
				</tr>
				<tr>
					<td width="100%"><label>Verify Password: <input type="password" name="password2" size="25"> </label></td>
				</tr>
				<tr>
					<td width="100%"><input type="submit" value="Register!"></td>
				</tr>
			</table>
		</form>
	</body>
</html>