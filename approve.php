<?php
	include("connection.php");

	$id = $_GET['id'];

	$query = "UPDATE request SET status = 1 WHERE id = '".$id."' ;";

	$result = mysql_query($query);

	header("Location: pending.php");
	
	mysql_close($conn);
?>