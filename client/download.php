<?php
	include("../connection.php");

	$id = $_GET['id'];
	$crt = $_GET['crt'];

	$query = "SELECT nama, sertifikat, LENGTH(sertifikat) FROM request WHERE id = '".$id."' ;";

	$result = mysql_query($query);

	$row = mysql_fetch_array($result);

	$name = $row[0];
	$sertifikat = $row[1];
	$size = $row[2];
	//echo $size;

	if ($crt == "der") {
		$name .= ".der";
		header("Content-length: $size");
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$name");
		echo $sertifikat;

		//echo $size;
	}
	else {
		$sertifikat1 = "-----BEGIN CERTIFICATE-----";
		$sertifikat1 .= "\r\n";

		// $tampung = base64_encode($sertifikat);
		// $tampung1 = "";

		// $j = 0;
		// for ($i = 0; $i < strlen($tampung); $i++) {
		// 	$tampung1 .= substr( $tampung, $i - $j, $i - $j + 1 );
		// 	if ($i == 64 + $j) {
		// 		$tampung1 .= "\r\n";
		// 		$j+=2;
		// 		$i++;
		// 		echo $i." ";
		// 	}
		// }
		// echo $tampung;
		// echo "<br>";
		// echo $tampung1;

		$str = chunk_split(base64_encode($sertifikat), 64);

		$sertifikat1 .= $str;
		$sertifikat1 .= "-----END CERTIFICATE-----";
		$sertifikat1 .= "\r\n";
		$size = strlen($sertifikat1);
		$name .= ".crt";

		header("Content-length: $size");
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=$name");
		echo $sertifikat1;
	}
	mysql_close($conn);
?>