<?php
	
	// generate key pair, if haven't key pair
	// if ( !file_exists("ca_private.key") || !file_exists("ca_public.key") ) {
		
		

	// 	$open_ssl = $_SERVER['OPENSSL_CONF'];

	// 	$config = array(
	// 		// "config" => "C:/xampp/apache/bin/openssl.cnf",
	// 		"digest_alg" => "sha512",
	// 		"private_key_bits" => 1024,
	// 		"private_key_type" => OPENSSL_KEYTYPE_RSA,
	// 	);
		
	// 	$res = openssl_pkey_new($config);

	// 	echo "res=".$res;

	// 	var_dump($res);

	// 	// openssl_pkey_export($res, $privKey);

	// 	// $pubKey = openssl_pkey_get_details($res);
	// 	// $pubKey = $pubKey["key"];

	// 	// $privKey_file = fopen("ca_private.key", "w");
	// 	// fwrite($privKey_file, $privKey);

	// 	// $pubKey_file = fopen("ca_public.key", "w");
	// 	// fwrite($pubKey_file, $pubKey);

	// }

	// $fp=fopen ("capubkey.pem","r");
	// $pub_key=fread ($fp,8192);
	// fclose($fp);
	// $PK="";
	// $PK=openssl_get_publickey($pub_key);
	// echo $PK;
	// $plaintext = "String to encrypt";
	// echo $plaintext;
	// openssl_public_encrypt($plaintext, $encrypted, $PK);
	// echo $encrypted;   //encrypted string

	// $key = 'password to (en/de)crypt';
	// $string = 'string to be encrypted';

	// $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
	// $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($key))), "\0");

	// var_dump($encrypted);
	// var_dump($decrypted);

	// include('Crypt/RSA.php');

	// $privatekey = file_get_contents('caprivate.key');

	// $rsa = new Crypt_RSA();
	// $rsa->loadKey($privatekey);

	// $plaintext = new Math_BigInteger('aaaaaa');
	// echo $rsa->_exponentiate($plaintext)->toBytes();

	// echo 'ini: ', get_cfg_var('cfg_file_path');


// 	/* Create the private and public key */
// 	$res = openssl_pkey_new();
// 	echo openssl_error_string(); // May throw error even though its working fine!

// 	/* Extract the private key from $res to $privKey */
// 	openssl_pkey_export($res, $privKey);
// 	openssl_error_string(); // May throw error even though its working fine!

// 	/* Extract the public key from $res to $pubKey */
// 	$pubKey = openssl_pkey_get_details($res);
// 	$pubKey = $pubKey["key"];

// 	$data = 'i.amniels.com is a great website!';

// 	 Encrypt the data using the public key
// 	 * The encrypted data is stored in $encrypted 
// 	openssl_public_encrypt($data, $encrypted, $pubKey);

// 	/* Decrypt the data using the private key and store the
// 	 * result in $decrypted. */
// 	openssl_private_decrypt($encrypted, $decrypted, $privKey);

// 	echo $decrypted;

$privateKey = openssl_pkey_new();
        var_dump(getenv('OPENSSL_CONF'));
        while($message = openssl_error_string()){
            echo $message.'<br />'.PHP_EOL;
        }


// while($e = openssl_error_string() ) {
//     print_r($e."\n");
// }
?>