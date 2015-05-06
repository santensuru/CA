<?php
	include("../connection.php");

	if ( !(isset($_POST['nama']) && $_FILES['key']['size'] > 0) ) {
		header("Location: gagal.html");
	}
	else {

		$nama = $_POST['nama'];
		$algoritma = $_POST['algoritma'];

		$fileName = $_FILES['key']['name'];
		$tmpName  = $_FILES['key']['tmp_name'];
		$fileSize = $_FILES['key']['size'];
		$fileType = $_FILES['key']['type'];

		echo $fileType;

		if ($fileType != 'application/octet-stream')
			header("Location: gagal.html");

		else {

			$fp      = fopen($tmpName, 'r');
			$content = fread($fp, filesize($tmpName));
			$content = addslashes($content);
			fclose($fp);

			$tgl = date('Y-m-d');

			$query = "INSERT INTO request (nama, public_key, algoritma, tgl_request) VALUES ('$nama', '$content', '$algoritma', '$tgl');";

			//echo base64_encode($content);

			mysql_query($query);

			//echo mysql_error();

			header("Location: oke1.html");

			mysql_close($conn);
		}
	}
?>