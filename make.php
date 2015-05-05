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
	$query = "SELECT public_key, nama FROM request WHERE status = 1 AND id = '$id' ;";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$publickey = $row[0];
	$nama = $row[1];

	// echo $nama." ".$publickey;

	// $key = "-----BEGIN PUBLIC KEY-----";
	// $key .= "\r\n";
	// $str = chunk_split(base64_encode($publickey), 64);
	// $key .= $str;
	// $key .= "-----END PUBLIC KEY-----";
	// $key .= "\r\n";

	// echo $key;

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

	$x509 = new File_X509();
	$x509->setStartDate('-1 month');
	$x509->setEndDate('+1 year');
	$x509->setSerialNumber(chr($id));

	// var_dump($subject->getPublicKey());

	$result = $x509->sign($issuer, $subject);

	$content = $x509->saveX509($result, FILE_X509_FORMAT_DER);
	// var_dump( $x509->saveX509($result) );
	// var_dump($result);

	$content = addslashes($content);

	$tgl = date('Y-m-d');
	$tgl1 = explode('-', $tgl);
	$year = $tgl1[0] + 1;
	// echo $year;
	$tgl2 = str_replace($tgl1[0], $year, $tgl);

	$query = "UPDATE request SET status = 2, tgl_create = '$tgl', sertifikat = '$content', tgl_expired = '$tgl2'  WHERE id = '$id' ;";

	$result = mysql_query($query);

	// echo $result;

	// echo mysql_error();

	header("Location: create.php");
	
	mysql_close($conn);
?>