<?php
	extension_loaded('openssl') or die('php need openssl extended support');
	//$p12FileName = "";		//私钥文件路径
	//$cerFileName2 = "";		//公钥文件路径
	//$text = "123";		//需要加密的文本字符串
	function encrypt(string $p12FileName, string $cerFileName2, string $text){
		//$text="......";
		
		//私钥及密码 
		//$privatekeyFile = dirname(__FILE__).'/private_key.pem';		//私钥
		$passphrase = 'openssl';		//密码
		
		//摘要及签名算法
		$digestAlgo = 'MD5';
		$algo = OPENSSL_ALGO_MD5;
		
		//加载私钥
		$privatekey = openssl_pkey_get_private(file_get_contents($p12FileName),$passphrase);
		($privatekey) or die('private cant be used');
		
		//生成摘要
		$digest = openssl_digest($text, $digestAlgo);		//通过hash得到摘要,摘要支持MD5算法

		//签名
		$signature = '';
		openssl_sign($digest, $signature, $privatekey, $algo);		//signature 调用成功后生成的签名
		$signature = base64_encode($signature);
		
		var_dump($signature);
		
		//公钥
		//$publickeyFile = dirname(__FILE__).'/public_key.pem';
		
		//加载公钥
		$publickey = openssl_pkey_get_public(file_get_contents($cerFileName2));
		($publickey) or die('public key cant be used');
		
		//使用公钥进行加密
		$encryptedText = '';
		openssl_public_encrypt($text, $encryptedText, $publickey);
		
		var_dump(base64_encode($encryptedText));
		return $encryptedText;
	}	
	
	
	function decrypt($encryptedText, $privatekeyFile, $publickeyFile, $text){
		//$text = '......';
		
		//base64_encode过的加密数据
		//$encryptedText = 'xxxxxx';
		
		//私钥及密码
		//$privatekeyFile = dirname(__FILE__).'/private_key.pem';
		$passphrase = 'openssl';
		
		//加载私钥
		$privatekey = openssl_pkey_get_private(file_get_contents($privatekeyFile), $passphrase);
		
		//使用私钥进行解密
		$sensitiveText = '';
		openssl_private_decrypt(base64_decode($encryptedText), $sensitiveText, $privatekey);
		
		var_dump($sensitiveText);		//理论上与digest一致
		//公钥
		//$publickeyFile = dirname(__FILE__).'/public.key';
		
		//摘要及签名算法
		$digestAlgo = 'MD5';
		$algo = OPENSSL_ALGO_MD5;
		
		//加载公钥
		$publickey = openssl_pkey_get_public(file_get_contents($publickeyFile));
		
		//生成摘要
		$digest = openssl_digest($text, $digestAlgo);
		
		//验签
		$verify = openssl_verify($digest, base64_decode($signature), $publickey, $algo);
		var_dump($verify);		// int(1)表示验签成功
	}
?>
