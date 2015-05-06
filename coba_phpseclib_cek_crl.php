<?php
	ini_set('max_execution_time', 300); 

	set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib0.3.10');

	include('Net/SSH2.php');

	// include('phpseclib0.3.10/Crypt/RSA.php');

	include('phpseclib0.3.10/File/X509.php');

	// $cert_file = fopen("ca_crl.crt", "r");

	// $cert = fread ( $cert_file , 4096 );

	// echo $cert;

	$cert = "-----BEGIN X509 CRL-----
	MIHwMF0CAQEwCwYJKoZIhvcNAQEFMBcxFTATBgNVBAMMDEtJSi5Qcm8uVGhvchcN
	MTUwNTA2MTc0NTAxWqAjMCEwHwYDVR0jBBgwFoAU1W8ih9dtSPSvejnU/prXZDEa
	y6QwCwYJKoZIhvcNAQEFA4GBAHPxbdiRKQNFiHmnZprHw0cgmRY/ZVbicEq3Nl/p
	oLGfUPczdBTZHOy6W3NvnY0LbxggcC5FTEFnayOpN5u+umPbEUQFJgUrGEn2FJ/R
	P8E+sgj62g3ZW1e773p0UsrJIjPNSdIqazmjFwImk9o7VGGejc60iiFHulJ11ILc
	qHu5
	-----END X509 CRL-----";

	echo $cert;

	$x509 = new File_X509();
	$crl = $x509->loadCRL($cert); // see selfsigned.crt
	// print_r($x509);
	echo $x509->validateSignature(true) ?
	    'valid' :
	    'invalid';
?>