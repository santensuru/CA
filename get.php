<html>
	<head>
		<title>request CA</title>
	</head>
	<body>
		<h1>CA</h1>
		
		<!-- content area -->
		<div>
			<table>
				<tr>
					<td>Nama Instansi</td>
					<td>Sertifikat</td>
					<td>Tanggal Kadaluarsa</td>
				</tr>
			<?php
				include("connection.php");

				$query = "SELECT id, nama, tgl_expired FROM request WHERE status = 1 ;";

				$result = mysql_query($query);

				while ($row = mysql_fetch_array($result)) {
					echo "				<tr>
					<td>".$row[1]."</td>
					<td><a href='download.php?id=".$row[0]."'>download</a></td>
					<td>".$row[2]."</td>
				</tr>"."\r\n";
				}

				mysql_close($conn);
			?>
			</table>
		</div>

	</body>
</html>