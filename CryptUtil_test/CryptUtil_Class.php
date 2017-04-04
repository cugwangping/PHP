<?php
	//phpinfo();
	/**require_once 'signature.php';
	require_once 'verify.php';
	require_once 'encrypt.php';
	require_once 'decrypt.php';
	*/
	/**
	$filename = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client.p12';
	$password = 'openssl';
	$certificate = array();
	$worked = openssl_pkcs12_read(file_get_contents($filename), $certificate, $password);
	if($worked) 
	{
		echo print_r($certificate, true);
		echo print_r($certificate['pkey'], true);
		private_key=$certificate['pkey'];
	}
	else
	{
		echo openssl_error_string();
	}*/
	
	//$filename = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client11.cer';
	
	
	/** $certificateCAcer = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client11.cer';
	openssl_get_publickey($certificateCAcer);
	$certificateCAcerContent = file_get_contents($certificateCAcer);
	// Convert .cer to .pem, cURL uses .pem 
	$certificateCApemContent =  '-----BEGIN CERTIFICATE-----'.PHP_EOL
	    .chunk_split(base64_encode($certificateCAcerContent), 64, PHP_EOL)
	    .'-----END CERTIFICATE-----'.PHP_EOL;
	$certificateCApem = $certificateCAcer.'.pem';
	file_put_contents($certificateCApem, $certificateCApemContent); 
	//var_dump($certificateCApemContent);
	var_dump($certificateCApem);
	$publickeyID = openssl_pkey_get_public($certificateCApemContent); 
	*/
	/**
	$new_password = null;
	$result = null;
	$worked = openssl_pkcs12_export($results['pkey'], $result, $new_password);
	if($worked)
	{
		echo "It worked!  Your new pkey is:\n", $result;
	} 
	else
	{
		echo openssl_error_string();
	}
	*/
	/**
	//签名
	$fmsg=signature();		//订单签名后的数据

	//gmsg=des		//密钥加密后的数据
	$encryptedData=encrypt();		//加密
	verify($fmsg);	//验签
	decrypt($encryptedData);		//解密
	*/

	function generate_des_key($length=16)
	{
		$des_key='';
		for($i = 0; $i < $length; $i++)
		{
			$des_key .=mt_rand(0,9);
		}
		echo $des_key;
	}
	
	generate_des_key(16);
	
?>