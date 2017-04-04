<?php
	//include 'Crypt.php';
	
// 	$filename = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client.p12';
// 	$password = 'openssl';
// 	$certificate = array();
// 	$worked = openssl_pkcs12_read(file_get_contents($filename), $certificate, $password);
// 	if($worked)
// 	{
// 		//echo print_r($certificate, true);
// 		//echo print_r($certificate['pkey'], true);
// 		//echo print_r($certificate['cert'], true);
// 		$private_key=$certificate['pkey'];
// 		$passphrase = null;
// 		$public_key=$certificate['cert'];
// 	}
// 	else
// 	{
// 		echo openssl_error_string();
// 	}
	
// 	$input_file='D:\Cache\1697500213\FileRecv\CreateEncryptedString\out\production\CreateEncryptedString\input.txt';
// 	$data = file_get_contents($input_file);
	//$crypt= new Crypt(); 
	//***********加密*********************
	//签名
	//$signature=$crypt->signature();
	//des加密
	//$des_key = $crypt->generate_des_key();	//des密钥
	//$des_encrypt_text=$crypt->DesEncrypt($des_key);
	//
	//
	//$encryptedData=$crypt->RsaEncrypt();
	
	//***************解密****************
	//为des密钥解密
	//$deskey=$crypt->RsaDecrypt($encryptedData);
	//des文本解密
	//$text=$crypt->DesDecrypt($des_key, $des_encrypt_text);
	//echo $text;
	//验签
	//$crypt->verify($data, $public_key, $signature);
	
	include "encrypt.php";
	$encrtpt = new encrypted();
	$encryptedData = $encrtpt ->encrypt();
	$encrtpt -> decrypt($encryptedData);
?>