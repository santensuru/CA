<?php
	include("connection.php");

	$id = $_GET['id'];
	$crt = $_GET['crl'];

	$query = "SELECT nama, crl, LENGTH(crl) FROM request WHERE id = '".$id."' ;";

	$result = mysql_query($query);

	$row = mysql_fetch_array($result);

	$name = $row[0];
	$crl = $row[1];
	$size = $row[2];
	//echo $size;

	if ($crt == "der") {
		$name .= ".der";
		header("Content-length: $size");
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$name");
		echo $crl;

		//echo $size;
	}
	else {
		$crl1 = "-----BEGIN X509 CRL-----";
		$crl1 .= "\r\n";

		$str = chunk_split(base64_encode($crl), 64);

		$crl1 .= $str;
		$crl1 .= "-----END X509 CRL-----";
		$crl1 .= "\r\n";
		$size = strlen($crl1);
		$name .= ".crt";

		header("Content-length: $size");
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$name");
		echo $crl1;
	}
	mysql_close($conn);
?>