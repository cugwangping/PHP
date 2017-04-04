<?php
	function verify($signature){
		// �������ݣ�ͬ����һ��
		$data = 'If you are still new to things, we��ve provided a few walkthroughs to get you started.';
		
		// ��Կ
		$public_key_file = 'rsa_public_key.pem';
		//$public_key_file = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client11.cer';
		
		// ժҪ��ǩ�����㷨��ͬ����һ��
		$digestAlgo = 'MD5';
		$algo = OPENSSL_ALGO_MD5;
		
		// ���ع�Կ
		$publickey = openssl_pkey_get_public(file_get_contents($public_key_file));
		
		// ����ժҪ
		$digest = openssl_digest($data, $digestAlgo);
		
		// ��ǩ
		$verify = openssl_verify($digest, base64_decode($signature), $publickey, $algo);
		var_dump($verify); // int(1)��ʾ��ǩ�ɹ�
	}
?>