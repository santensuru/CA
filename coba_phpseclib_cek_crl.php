<?php
	ini_set('max_execution_time', 300); 

	set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib0.3.10');

	include('Net/SSH2.php');

	// include('phpseclib0.3.10/Crypt/RSA.php');

	include('phpseclib0.3.10/File/X509.php');

	$cert_file = fopen("ca_crl.crt", "r");

	$cert = fread ( $cert_file , 4096 );

	echo $cert;

	$crl = new File_X509();
	$cert = $crl->loadCRL($cert); // see selfsigned.crt
	echo $crl->validateSignature(true) ?
	    'valid' :
	    'invalid';
?>