<?php
	extension_loaded('openssl');
	class CryptUtil
	{
		function encrypt(string $p12FileName, string $cerFileName2, string $text)
		{
			//$text="......";
			
			//私钥及密码 
			$privatekeyFile = dirname(__FILE__).'/private_key.pem';		//私钥
			$passphrase = '';		//密码
			
			//摘要及签名算法
			$digestAlgo = 'MD5';
			$algo = OPENSSL_ALGO_MD5;
			
			//加载私钥
			$privatekey = openssl_pkey_get_private(file_get_contents($privatekeyFile),$passphrase);
			
			//生成摘要
			$digest = openssl_digest($text, $digestAlgo);

			//签名
			$signature = '';
			openssl_sign($digest, $signature, $privatekey, $algo);
			$signature = base64_encode($signature);
			
			var_dump($signature);
			
			//公钥
			$publickeyFile = dirname(__FILE__).'/public_key.pem';
			
			//加载公钥
			$publickey = openssl_pkey_get_public(file_get_contents($publickeyFile));
			
			//使用公钥进行加密
			$encryptedText = '';
			openssl_public_encrypt($text, $encryptedText, $publickey);
			
			var_dump(base64_encode($encryptedText));
		}	
		
		
		function decrypt($fmsg, $gmsg)
		{
			$text = '......';
			
			//base64_encode过的加密数据
			$encryptedText = 'xxxxxx';
			
			//私钥及密码
			$privatekeyFile = '/path/private.key';
			$passphrase = '';
			
			//加载私钥
			$privatekey = openssl_pkey_get_private(file_get_contents($privatekeyFile), $passphrase);
			
			//使用私钥进行解密
			$sensitiveText = '';
			openssl_private_decrypt(base64_decode($encryptedText), $sensitiveText, $privatekey);
			
			var_dump($sensitiveText);		//理论上与Text一致
			//公钥
			$publickeyFile = '/path/public.key';
			
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
	}
?>