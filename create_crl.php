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
					<td>ID Sertifikat</td>
					<td>Tanggal Kadaluarsa</td>
				</tr>
			<?php
				include("connection.php");

				$query = "SELECT id, nama FROM request WHERE status = 2 ;";

				$result = mysql_query($query);

				while ($row = mysql_fetch_array($result)) {
					echo "				<tr>
					<td>".$row[1]."</td>
					<td>".$row[0]."</td>
					<td><a href='revoke.php?id=".$row[0]."'>revoke</a></td>
				</tr>"."\r\n";
				}

				mysql_close($conn);
			?>
			</table>
		</div>

	</body>
</html>