<?php
	extension_loaded('openssl') or die('php need openssl extended support');
	
	class Crypt
	{
		function signature(){
			$data = 'If you are still new to things, we’ve provided a few walkthroughs to get you started.';
				
			// 私钥及密码
			$private_key_file = 'rsa_private_key.pem';
			//$private_key_file = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client.p12';
			$passphrase = 'openssl';
		
			// 摘要及签名的算法
			$digestAlgo = 'MD5';	//单项散列算法
			$algo = OPENSSL_ALGO_MD5;
			//$algo = OPENSSL_ALGO_SHA1;
			// 加载私钥
			$private_key_content = file_get_contents($private_key_file);
			$private_key = openssl_pkey_get_private($private_key_content, $passphrase);
		
			// 生成摘要
			$digest = openssl_digest($data, $digestAlgo);
		
			// 私钥签名
			$signature = '';
			openssl_sign($digest, $signature, $private_key, $algo);
			$signature = base64_encode($signature);
		
			var_dump($signature);
			return $signature;
		}
		
		function verify(){
			// 测试数据，同上面一致
			$data = 'If you are still new to things, we’ve provided a few walkthroughs to get you started.';
		
			// 公钥
			$public_key_file = 'rsa_public_key.pem';
		    //$public_key_file = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client11.cer';
		
			// 摘要及签名的算法，同上面一致
			$digestAlgo = 'MD5';
			$algo = OPENSSL_ALGO_MD5;
		
			// 加载公钥
			$public_key_content = file_get_contents($public_key_file);
			$public_key = openssl_pkey_get_public($public_key_content);
		
			// 生成摘要
			$digest = openssl_digest($data, $digestAlgo);
		
			// 验签
			$verify = openssl_verify($digest, base64_decode($signature), $public_key, $algo);
			var_dump($verify); // int(1)表示验签成功
		}
		
		function RsaEncrypt(){
			// 测试数据
			$data = 'If you are still new to things, we’ve provided a few walkthroughs to get you started.';
		
			// 公钥
			$public_key_file = 'rsa_public_key.pem';
			//$public_key_file = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client11.cer';
		
			// 加载公钥
			$public_key = openssl_pkey_get_public(file_get_contents($public_key_file));
		
			// 使用公钥进行加密
			$encryptedData = '';
			openssl_public_encrypt($data, $encryptedData, $public_key);
		
			var_dump(base64_encode($encryptedData));
			return base64_encode($encryptedData);
		}
		
		function RsaDecrypt($encryptedData){
			// 测试数据
			//$data = 'If you are still new to things, we’ve provided a few walkthroughs to get you started.';
		
			// base64_encode过的加密数据
			//$encryptedData = 'xxxxxxxxxx';
		
			// 私钥及密码
			$private_key_file = 'rsa_private_key.pem';
			//$private_key_file = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client.p12';
			$passphrase = '';
			//$passphrase = 'openssl';
		
			// 加载私钥
			$private_key = openssl_pkey_get_private(file_get_contents($private_key_file), $passphrase);
		
			// 使用私钥进行解密
			$sensitiveData = '';
			openssl_private_decrypt(base64_decode($encryptedData), $sensitiveData, $private_key);
		
			//var_dump($sensitiveData); // 应该跟$data一致
			return $sensitiveData;
		}
		
		function DesEncrypt($des_key)
		{
			$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
			$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
			//$key = "1234567891234567";	//密钥
			$text = "example";	//需要加密的内容
			//echo $text;
			
			$encrypttext =base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $des_key, $text, MCRYPT_MODE_ECB, $iv));
			//echo $encrypttext;	//加密后的内容
			
			return $encrypttext; 
		}
		
		function DesDecrypt($des_key, $encrypttext)
		{
			$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
			$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		
				
			//解密后的内容
			return mcrypt_decrypt(MCRYPT_RIJNDAEL_128,$des_key,base64_decode($encrypttext),MCRYPT_MODE_ECB,$iv);
		}
		
		//生成随机的des密钥
		function generate_des_key($length=16)
		{
			$des_key='';
			for($i = 0; $i < $length; $i++)
			{
				$des_key .=mt_rand(0,9);
			}
			return $des_key;
		}
	}
?>