<?php
	$servername = '10.151.44.68';
	$username = 'root';
	$password = '';
	$database = 'kij_ca';

	// Create connection
	$conn = mysql_connect($servername, $username, $password);

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysql_error());
	}
	//echo "Connected successfully";

	$result = mysql_select_db($database);

	//echo mysql_error();
?>