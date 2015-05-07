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
					<td>Sertifikat Revoke [PEM]</td>
					<td>Sertifikat Revoke [DER]</td>
				</tr>
			<?php
				echo "				<tr>
					<td><a href='download_crl_ca.php?id=".$row[0]."&crl=pem'>download</a></td>
					<td><a href='download_crl_ca.php?id=".$row[0]."&crl=der'>download</a></td>
				</tr>"."\r\n";
			?>
			</table>
		</div>

	</body>
</html>