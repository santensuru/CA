<?php 

	ini_set('max_execution_time', 300); 

	set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib0.3.10');

	include('Net/SSH2.php');

	include('phpseclib0.3.10/Crypt/RSA.php');

	include('phpseclib0.3.10/File/X509.php');

	$issuer = new File_X509(); 
	$issuer->setDNProp('id-at-organizationName', 'phpseclib demo cert'); 
	$privKey = new Crypt_RSA(); 
	$privKey->loadKey('-----BEGIN RSA PRIVATE KEY----- 
	MIICWwIBAAKBgQDR1VHopvujQwg7aZe6uvACg5ZLKYD1heP9hXlmJNGKkTvmV//uQ5PlWPTp99AW 
	FgU9QRM5cKkxw/0hC8+JTyc1CoqtdVAI/8l826+muJfiUaUALkAHSrw8537Xj2agJQRmaVNhUztA 
	G3y6yweav3dYLYJG3MDlcD4l2U9t6QDBGQIDAQABAoGAaMy+KBCeRaBJEENgwKZ1EQxfmBKWkgnZ 
	INn1FAr3jNmUrSrubDXcPAP97o0SpLVC0KEb1Ohr2KsmVcbsVIvv7CoK5h+fNTOZpm51Wev5VlHA 
	OO/FQtq4kTL9JpG/5vVbk5JFA1r7kC/W01Pwp8zpf8teM3NWKuciLUXy7RjCirECQQD0gmM8jWbS 
	wUmSYLEUOaqZnpzpqm+dTLov8ubf0Dsla6OgnCg5N0noVMPm5oFSJBhQOjmQnrXmXLJu8Soo0VUv 
	AkEA27HBjUe99ztdnP7uX6xhHX3XfUkk7TKZvulP1IvYnZggv3Nyyj+wqMsGavcOHwKfxoWo/Nim 
	YLO1vMUKkLrMNwJARFSn/QUbRizELccd1aQj/Bhqi5aY6KHHqpy8TrH3xYZmTP029H5yBh6iPMYQ 
	P+9caBdNfRANj5o6N2zoNk4B+wJAcnD/TTQw/ce79RtLWyU1laJHDWl7xd/U/QEWZ7bNiRKFBJYE 
	Ftzkjpjr5+54OakpR8W6iLPmv3r90a6m2UulMwJAINcNFkJHojkf+Vc/e2U7ll19UIh+TDI0UrYT 
	ZxJA2S/nhIz+A6cNTX+E+yHlTbJr5xu6jxexQ7HfU1hTWYNmUg== 
	-----END RSA PRIVATE KEY-----'); 
	$issuer->setPrivateKey($privKey); 


	$crl = new File_X509(); 
	$crl->revoke('111');
	$crl->loadCRL($crl->saveCRL($crl->signCRL($issuer, $crl)));
	$result = $crl->signCRL($issuer, new File_X509()); 
	echo $crl->saveCRL($result);

?>