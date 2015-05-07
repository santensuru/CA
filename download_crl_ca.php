<?php
	include("connection.php");

	$crt = $_GET['crt'];
	$crl = $_GET['crl'];

	if ($crt != null) {
		$cert_file = fopen("ca_certificat.crt", "r");

		$file = fread ( $cert_file , 4096 );
		$size = sizeof($file);
		$name .= "CA.crt";
		header("Content-length: $size");
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$name");
		echo $file;
	}
	else {
		$cert_file = fopen("ca_crl.pem", "r");

		$file = fread ( $cert_file , 4096 );
		$size = sizeof($file);
		$name .= "crl.crt";
		header("Content-length: $size");
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$name");
		echo $file;
	}
	
	// if ($crt == "der" || $crl == "der") {
	// 	if ($crt != null) {
	// 		$name .= "CA.der";
	// 		header("Content-length: $size");
	// 		header("Content-type: application/octet-stream");
	// 		header("Content-Disposition: attachment; filename=$name");
	// 	}
	// 	else {
	// 		$name .= "crl.der";
	// 		header("Content-length: $size");
	// 		header("Content-type: application/octet-stream");
	// 		header("Content-Disposition: attachment; filename=$name");
	// 	}
	// }
	// else {
	// 	if ($crt != null) {
	// 		$sertifikat = "-----BEGIN CERTIFICATE-----";
	// 		$sertifikat .= "\r\n";

	// 		$str = chunk_split(base64_encode($file), 64);

	// 		$sertifikat .= $str;
	// 		$sertifikat .= "-----END CERTIFICATE-----";

	// 		$name .= "CA.crt";

	// 		header("Content-length: $size");
	// 		header("Content-type: application/octet-stream");
	// 		header("Content-Disposition: attachment; filename=$name");
	// 	}
	// 	else {

	// 		$sertifikat = "-----BEGIN X509 CRL-----";
	// 		$sertifikat .= "\r\n";

	// 		$str = chunk_split(base64_encode($file), 64);

	// 		$sertifikat .= $str;
	// 		$crl1 .= "-----END X509 CRL-----";
	// 		$crl1 .= "\r\n";
	// 		$size = strlen($crl1);
	// 		$name .= "crl.crt";

	// 		header("Content-length: $size");
	// 		header("Content-type: application/octet-stream");
	// 		header("Content-Disposition: attachment; filename=$name");
	// 	}
	// }
	mysql_close($conn);
?>