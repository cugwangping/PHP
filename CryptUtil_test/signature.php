<?php
	if (!extension_loaded('openssl'))
		echo 0;
	function signature(){
		$data = 'If you are still new to things, we��ve provided a few walkthroughs to get you started.';
			
		// ˽Կ������
		$private_key_file = 'rsa_private_key.pem';
		//$private_key_file = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client.p12';
		$passphrase = 'openssl';
		
		// ժҪ��ǩ�����㷨
		$digestAlgo = 'MD5';	//����ɢ���㷨
		$algo = OPENSSL_ALGO_MD5;
		//$algo = OPENSSL_ALGO_SHA1;
		// ����˽Կ
		$privatekey = openssl_pkey_get_private(file_get_contents($private_key_file), $passphrase);
		
		// ����ժҪ
		$digest = openssl_digest($data, $digestAlgo);
		
		// ˽Կǩ��
		$signature = '';
		openssl_sign($digest, $signature, $privatekey, $algo);
		$signature = base64_encode($signature);
		
		var_dump($signature);
		return $signature;
	}
?>