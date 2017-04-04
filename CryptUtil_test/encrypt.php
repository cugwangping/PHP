<?php
	class encrypted{
		private $private_key;
		private $public_key;
		
		function __construct(){
			$web_client_file_name = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client.p12';
			$password = 'openssl';
			$input_file='D:\Cache\1697500213\FileRecv\CreateEncryptedString\out\production\CreateEncryptedString\input.txt';
			$certificate = array();
		
			$worked = openssl_pkcs12_read(file_get_contents($web_client_file_name), $certificate, $password);
			if($worked)
			{
				//echo print_r($certificate, true);
				echo print_r($certificate['pkey'], true);
				//echo print_r($certificate['cert'], true);
				$private_key_content = $certificate['pkey'];	//get private key
				$public_key_content = $certificate['cert'];	//get public key
				//$this->private_key = openssl_get_privatekey($private_key_content);
				//$this->public_key = openssl_get_publickey($public_key_content);
				$this->private_key = openssl_pkey_get_private($private_key_content);
				$this->public_key = openssl_pkey_get_public($public_key_content);
			}
			else
				echo openssl_error_string();
		}
		
		function encrypt(){
			// 测试数据
			$data = 'If you are still new to things, we’ve provided a few walkthroughs to get you started.';
		
			// 使用公钥进行加密
			$encryptedData = '';
			openssl_public_encrypt($data, $encryptedData, $this->public_key);
		
			var_dump(base64_encode($encryptedData));
			return base64_encode($encryptedData);
		}
		
		function decrypt($encryptedData){
			// 测试数据
			//$data = 'If you are still new to things, we’ve provided a few walkthroughs to get you started.';
		
			// 加载私钥
			//$privatekey = openssl_pkey_get_private(file_get_contents($private_key_file), $passphrase);
		
			// 使用公钥进行加密
			$sensitiveData = '';
			openssl_private_decrypt(base64_decode($encryptedData), $sensitiveData, $this->private_key);
		
			var_dump($sensitiveData); // 应该跟$data一致
		}
	}
?>