<?php
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$key = "1234567891234567";	//密钥
	$text = "example";	//需要加密的内容
	echo ($text) . "n";
	
	$crypttext =base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_ECB, $iv));
	echo $crypttext . "n";	//加密后的内容
	
	//解密后的内容
	echo mcrypt_decrypt(MCRYPT_RIJNDAEL_128,$key,base64_decode($crypttext),MCRYPT_MODE_ECB,$iv);