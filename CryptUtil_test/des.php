<?php
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$key = "1234567891234567";	//��Կ
	$text = "example";	//��Ҫ���ܵ�����
	echo ($text) . "n";
	
	$crypttext =base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_ECB, $iv));
	echo $crypttext . "n";	//���ܺ������
	
	//���ܺ������
	echo mcrypt_decrypt(MCRYPT_RIJNDAEL_128,$key,base64_decode($crypttext),MCRYPT_MODE_ECB,$iv);