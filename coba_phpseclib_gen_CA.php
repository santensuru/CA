<?php
	ini_set('max_execution_time', 300); 

	set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib0.3.10');

	include('Net/SSH2.php');

	include('phpseclib0.3.10/Crypt/RSA.php');

	include('phpseclib0.3.10/File/X509.php');

	// generate ca certificat key
	if ( !file_exists("ca_certificat.crt") ) {

		$privKey_file = fopen("ca_private.key", "r");
		$pubKey_file = fopen("ca_public.key", "r");

		$privatekey = fread ( $privKey_file , 4096 );
		$publickey = fread ( $pubKey_file , 1024 );

		$privKey = new Crypt_RSA();
		// extract($privKey->createKey());
		$privKey->loadKey($privatekey);

		// var_dump($privatekey);

		$pubKey = new Crypt_RSA();
		$pubKey->loadKey($publickey);
		$pubKey->setPublicKey();

		// self sign
		// $CAPrivKey = "";
		// $CASubject = "";

		$subject = new File_X509();
		$subject->setPublicKey($pubKey);
		$subject->setDNProp('KIJ Pro Thor CA', 'pro certificate authority, build using phpseclib');
		$subject->setDomain('KIJ.Pro.Thor');

		// self sign
		$issuer = new File_X509();
		$issuer->setPrivateKey($privKey);
		$issuer->setDN($subject->getDN());

		// var_dump($issuer);

		$x509 = new File_X509();
		$x509->setStartDate('-1 month');
		$x509->setEndDate('+1 year');
		$x509->setSerialNumber(chr(1));
		// $x509->makeCA();

		// print_r($x509);

		$result = $x509->sign($issuer, $subject);
		// var_dump($result);
		// var_dump($x509);

		// echo "the stunnel.pem contents are as follows:\r\n\r\n";
		// echo $privKey->getPrivateKey();
		// echo "\r\n";
		// echo $x509->saveX509($result);
		// echo "\r\n";


		$x509_file = fopen("ca_certificat.crt", "w");
		fwrite($x509_file, $x509->saveX509($result));

		fclose($x509_file);

	}

?>