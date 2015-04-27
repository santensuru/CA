<html>
	<head>
		<title>request CA</title>
	</head>
	<body>
		<h1>CA</h1>
		
		<!-- content area -->
		<div>
			<?php
				include("connection.php");

				$id = $_GET['id'];

				$query = "SELECT nama, sertifikat, LENGTH(sertifikat) AS size FROM request WHERE id = '".$id."' ;";

				$result = mysql_query($query);

				$row = mysql_fetch_array($result);

				$name = $row[0].".crt";
				$sertifikat = $row[1];
				$size = $row[2];

				header("Content-length: $size");
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=$name");
				echo $sertifikat;

				//echo base64_encode($sertifikat);

				mysql_close($conn);
			?>
			</table>
		</div>

	</body>
</html>