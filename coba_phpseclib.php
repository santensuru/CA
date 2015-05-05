<?php
	ini_set('max_execution_time', 300); 

	set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib0.3.10');

	include('Net/SSH2.php');

	include('phpseclib0.3.10/Crypt/RSA.php');

	// generate ca pair key
	if ( !file_exists("ca_private.key") || !file_exists("ca_public.key") ) {
		
		$privKey = new Crypt_RSA(); 
		extract($privKey->createKey()); 
		$privKey->loadKey($privatekey); 

		$pubKey = new Crypt_RSA(); 
		$pubKey->loadKey($publickey); 
		$pubKey->setPublicKey(); 

		$privKey_file = fopen("ca_private.key", "w");
		fwrite($privKey_file, $privatekey);

		$pubKey_file = fopen("ca_public.key", "w");
		fwrite($pubKey_file, $publickey);

		fclose($privKey_file);
		fclose($pubKey_file);

	}

?>