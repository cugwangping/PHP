<?php
	function verify($signature){
		// 测试数据，同上面一致
		$data = 'If you are still new to things, we’ve provided a few walkthroughs to get you started.';
		
		// 公钥
		$public_key_file = 'rsa_public_key.pem';
		//$public_key_file = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client11.cer';
		
		// 摘要及签名的算法，同上面一致
		$digestAlgo = 'MD5';
		$algo = OPENSSL_ALGO_MD5;
		
		// 加载公钥
		$publickey = openssl_pkey_get_public(file_get_contents($public_key_file));
		
		// 生成摘要
		$digest = openssl_digest($data, $digestAlgo);
		
		// 验签
		$verify = openssl_verify($digest, base64_decode($signature), $publickey, $algo);
		var_dump($verify); // int(1)表示验签成功
	}
?>