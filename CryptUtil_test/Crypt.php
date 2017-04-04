<?php
	extension_loaded('openssl') or die('php need openssl extended support');
	
	class Crypt
	{
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
			$private_key_content = file_get_contents($private_key_file);
			$private_key = openssl_pkey_get_private($private_key_content, $passphrase);
		
			// ����ժҪ
			$digest = openssl_digest($data, $digestAlgo);
		
			// ˽Կǩ��
			$signature = '';
			openssl_sign($digest, $signature, $private_key, $algo);
			$signature = base64_encode($signature);
		
			var_dump($signature);
			return $signature;
		}
		
		function verify(){
			// �������ݣ�ͬ����һ��
			$data = 'If you are still new to things, we��ve provided a few walkthroughs to get you started.';
		
			// ��Կ
			$public_key_file = 'rsa_public_key.pem';
		    //$public_key_file = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client11.cer';
		
			// ժҪ��ǩ�����㷨��ͬ����һ��
			$digestAlgo = 'MD5';
			$algo = OPENSSL_ALGO_MD5;
		
			// ���ع�Կ
			$public_key_content = file_get_contents($public_key_file);
			$public_key = openssl_pkey_get_public($public_key_content);
		
			// ����ժҪ
			$digest = openssl_digest($data, $digestAlgo);
		
			// ��ǩ
			$verify = openssl_verify($digest, base64_decode($signature), $public_key, $algo);
			var_dump($verify); // int(1)��ʾ��ǩ�ɹ�
		}
		
		function RsaEncrypt(){
			// ��������
			$data = 'If you are still new to things, we��ve provided a few walkthroughs to get you started.';
		
			// ��Կ
			$public_key_file = 'rsa_public_key.pem';
			//$public_key_file = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client11.cer';
		
			// ���ع�Կ
			$public_key = openssl_pkey_get_public(file_get_contents($public_key_file));
		
			// ʹ�ù�Կ���м���
			$encryptedData = '';
			openssl_public_encrypt($data, $encryptedData, $public_key);
		
			var_dump(base64_encode($encryptedData));
			return base64_encode($encryptedData);
		}
		
		function RsaDecrypt($encryptedData){
			// ��������
			//$data = 'If you are still new to things, we��ve provided a few walkthroughs to get you started.';
		
			// base64_encode���ļ�������
			//$encryptedData = 'xxxxxxxxxx';
		
			// ˽Կ������
			$private_key_file = 'rsa_private_key.pem';
			//$private_key_file = 'D:\Cache\1697500213\FileRecv\CreateEncryptedString\key\web-client.p12';
			$passphrase = '';
			//$passphrase = 'openssl';
		
			// ����˽Կ
			$private_key = openssl_pkey_get_private(file_get_contents($private_key_file), $passphrase);
		
			// ʹ��˽Կ���н���
			$sensitiveData = '';
			openssl_private_decrypt(base64_decode($encryptedData), $sensitiveData, $private_key);
		
			//var_dump($sensitiveData); // Ӧ�ø�$dataһ��
			return $sensitiveData;
		}
		
		function DesEncrypt($des_key)
		{
			$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
			$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
			//$key = "1234567891234567";	//��Կ
			$text = "example";	//��Ҫ���ܵ�����
			//echo $text;
			
			$encrypttext =base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $des_key, $text, MCRYPT_MODE_ECB, $iv));
			//echo $encrypttext;	//���ܺ������
			
			return $encrypttext; 
		}
		
		function DesDecrypt($des_key, $encrypttext)
		{
			$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
			$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		
				
			//���ܺ������
			return mcrypt_decrypt(MCRYPT_RIJNDAEL_128,$des_key,base64_decode($encrypttext),MCRYPT_MODE_ECB,$iv);
		}
		
		//���������des��Կ
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