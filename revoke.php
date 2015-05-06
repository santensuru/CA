<?php
	include("connection.php");

	$id = $_GET['id'];

	// create CA and store to lib
	ini_set('max_execution_time', 300); 

	set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib0.3.10');

	include('Net/SSH2.php');

	include('phpseclib0.3.10/Crypt/RSA.php');

	include('phpseclib0.3.10/File/X509.php');

	$caprivKey_file = fopen("ca_private.key", "r");

	$caprivatekey = fread ( $caprivKey_file , 4096 );

	$caprivKey = new Crypt_RSA();
	$caprivKey->loadKey($caprivatekey);
	// echo $caprivatekey;

	// issuer
	$query = "SELECT public_key, nama FROM request WHERE status = 2 AND id = '$id' ;";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$publickey = $row[0];
	$nama = $row[1];

	$pubKey = new Crypt_RSA();
	$pubKey->loadKey($publickey);
	$pubKey->setPublicKey();

	$subject = new File_X509();
	$subject->setPublicKey($pubKey);
	$subject->setDNProp($nama, $nama);
	$subject->setDomain($nama);

	$issuer = new File_X509();
	$issuer->setPrivateKey($caprivKey);
	$issuer->setDNProp('KIJ Pro Thor CA', 'pro certificate authority, build using phpseclib');
	$issuer->setDomain('KIJ.Pro.Thor');
	$issuer->setDN($issuer->getDN());

	// var_dump($issuer->getDN());

	$tgl = date('Y-m-d');

	$crl = new File_X509();
	$crl->revoke($id, $tgl);

	// var_dump($subject->getPublicKey());

	$result = $crl->signCRL($issuer, $subject);

	$content = $crl->saveCRL($result, FILE_X509_FORMAT_DER);
	// var_dump( $x509->saveX509($result) );
	// var_dump($result);

	$content = addslashes($content);

	$query = "UPDATE request SET status = 4, tgl_expired = '$tgl', crl = '$content'  WHERE id = '$id' ;";

	$result = mysql_query($query);

	// echo $result;

	// echo mysql_error();

	header("Location: create_crl.php");
	
	mysql_close($conn);
?>