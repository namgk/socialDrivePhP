<?php

	// MySQL connect information.
	$c_username = "vsnadmin";
	$c_password = "vsn";
	$c_host = "localhost";
	$c_database = "VSN";

	// Connect.
	$con = mysqli_connect($c_host, $c_username, $c_password, $c_database)
	or die ("It seems this site's database isn't responding.");

?>
