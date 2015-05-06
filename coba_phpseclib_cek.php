<?php
	ini_set('max_execution_time', 300); 

	set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib0.3.10');

	include('Net/SSH2.php');

	// include('phpseclib0.3.10/Crypt/RSA.php');

	include('phpseclib0.3.10/File/X509.php');

	$cert_file = fopen("ca_certificat.crt", "r");

	$cert = fread ( $cert_file , 4096 );

	$x509 = new File_X509();
	if ($x509->loadCA($cert)) {
		var_dump ($x509->loadX509($cert));
	}
	// $certs = $x509->loadX509($cert); // see selfsigned.crt
	echo $x509->validateSignature(true) ?
	    'valid' :
	    'invalid';
?>