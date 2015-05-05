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
					<td>Algoritma Kunci Publik</td>
					<td>Tanggal Permintaan</td>
				</tr>
			<?php
				include("connection.php");

				$query = "SELECT id, nama, algoritma, tgl_request FROM request WHERE status = 1 ;";

				$result = mysql_query($query);

				while ($row = mysql_fetch_array($result)) {
					echo "				<tr>
					<td>".$row[1]."</td>
					<td>".$row[2]."</td>
					<td>".$row[3]."</td>
					<td><a href='make.php?id=".$row[0]."'>buat</a></td>
				</tr>"."\r\n";
				}

				mysql_close($conn);
			?>
			</table>
		</div>

	</body>
</html>