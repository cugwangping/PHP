<?php
	include('CryptUtil_Class.php');
	//generate 1024 long's private key instruction: opensll genrsa -out rsa_private_key.pem 1024
	
	//generate corresponding public key instruction: openssl rsa -in rsa_private_key.pem -pubout -out rsa_public_key.pem

	$p12FileName = 'rsa_private_key.pem';
	$cerFileName2 = 'rsa_public_key.pem';
	$text = "123ABC";
	echo 'The original data is', $text, PHP_EOL;
	(file_exists($p12FileName) && file_exists($cerFileName2) or die("private key or public key's file path is incorrect"));
	$encryptedText = encrypt($p12FileName, $cerFileName2, $text);
	decrypt($encryptedText, $p12FileName, $cerFileName2, $text);
?>
